<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    // 1. Menampilkan daftar rekap laporan dengan filter
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('created_at', $request->bulan)
                  ->whereYear('created_at', $request->tahun);
        }

        $laporans = $query->latest()->get();
        $tahunList = Laporan::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');

        return view('daftar_laporan', compact('laporans', 'tahunList'));
    }

    // 2. Menampilkan halaman form lapor warga
    public function create()
    {
        return view('lapor');
    }

    // 3. Menyimpan data laporan ke database
    public function store(Request $request)
    {
        $data = $request->only(['nama_pelapor', 'no_hp', 'judul_laporan', 'lokasi', 'latitude', 'longitude', 'deskripsi']);
        
        // Tangkap IP Address
        $data['ip_address'] = $request->ip();
        
        // Buat Kode Tiket Unik
        $data['kode_tiket'] = 'LPR-' . strtoupper(Str::random(6));

        // Proses Upload Foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }

        $laporan = Laporan::create($data);

        // Redirect kembali ke form dengan pesan sukses DAN kode tiket untuk SweetAlert
        return redirect('/lapor')->with([
            'success' => 'Laporan berhasil dikirim! Simpan Kode Tiket Anda.',
            'kode_tiket' => $laporan->kode_tiket
        ]);
    }

    // 4. Cetak PDF
    public function exportPdf(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('created_at', $request->bulan)
                  ->whereYear('created_at', $request->tahun);
        }

        $laporans = $query->latest()->get();
        $pdf = Pdf::loadView('pdf_laporan', compact('laporans'));
        
        return $pdf->download('rekap-laporan-' . now()->format('d-m-Y') . '.pdf');
    }

    // 5. Menampilkan form edit
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('edit_laporan', compact('laporan'));
    }

    // 6. Menyimpan hasil update status
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return redirect('/detail-laporan/' . $id)->with('success', 'Status laporan berhasil diperbarui!');
    }

    // 7. Menghapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect('/daftar-laporan')->with('success', 'Laporan berhasil dihapus!');
    }

    // 8. Menampilkan form lacak & chat (untuk warga)
    public function lacakForm(Request $request)
    {
        $laporan = null;
        $chats = null;

        if ($request->has('kode_tiket')) {
            $laporan = Laporan::where('kode_tiket', $request->kode_tiket)->first();
            if ($laporan) {
                $chats = $laporan->chats()->orderBy('created_at', 'asc')->get();
            }
        }

        return view('lacak', compact('laporan', 'chats'));
    }

    // 9. Fungsi lupa kode tiket
    public function lupaTiket(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'no_hp' => 'required'
        ]);

        $laporans = Laporan::where('nama_pelapor', 'LIKE', '%'.$request->nama_pelapor.'%')
                           ->where('no_hp', $request->no_hp)
                           ->latest()
                           ->get();

        return view('lupa_tiket', compact('laporans'));
    }

    // 10. Menampilkan halaman detail laporan (untuk admin)
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        $chats = $laporan->chats()->orderBy('created_at', 'asc')->get();
        
        return view('detail_laporan', compact('laporan', 'chats'));
    }

    // 11. Menampilkan daftar laporan yang perlu ditindaklanjuti
    public function tindakLanjutIndex()
    {
        $laporans = Laporan::where('status', '!=', 'Selesai')->latest()->get();
        return view('tindak_lanjut', compact('laporans'));
    }

    // 12. Ambil data chat via AJAX (Real-time)
    public function fetchChat($id)
    {
        $laporan = Laporan::findOrFail($id);
        $chats = $laporan->chats()->orderBy('created_at', 'asc')->get();
        
        $data = $chats->map(function($chat) use ($laporan) {
            return [
                'pengirim' => $chat->pengirim,
                'nama' => $chat->pengirim == 'Warga' ? $laporan->nama_pelapor : 'Admin (Petugas)',
                'pesan' => $chat->pesan,
                'waktu' => $chat->created_at->format('H:i')
            ];
        });

        return response()->json($data);
    }

    // 13. Kirim chat via AJAX (Real-time)
    public function kirimChat(Request $request, $id)
    {
        $request->validate(['pesan' => 'required']);

        Chat::create([
            'laporan_id' => $id,
            'pengirim' => $request->pengirim,
            'pesan' => $request->pesan
        ]);

        return response()->json(['status' => 'success']);
    }
}