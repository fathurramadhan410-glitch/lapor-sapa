<?php

use App\Models\Laporan;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// HALAMAN UTAMA (LANDING PAGE) DIALIHKAN KE TENTANG SISTEM
Route::get('/', function () {
    return view('tentang');
});

Route::get('/dashboard', function () {
    $totalLaporan = Laporan::count();
    $laporanBaru = Laporan::where('status', 'Diterima')->count();
    $laporanDiproses = Laporan::where('status', 'Diproses')->count();
    $laporanSelesai = Laporan::where('status', 'Selesai')->count();
    $mapLaporans = Laporan::whereNotNull('latitude')->get();

    return view('dashboard', compact('totalLaporan', 'laporanBaru', 'laporanDiproses', 'laporanSelesai', 'mapLaporans'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ROUTE MILIK ADMIN
    Route::get('/daftar-laporan', [LaporanController::class, 'index']);
    Route::get('/detail-laporan', [LaporanController::class, 'tindakLanjutIndex']);
    Route::get('/detail-laporan/{id}', [LaporanController::class, 'show']);
    Route::get('/edit-laporan/{id}', [LaporanController::class, 'edit']);
    Route::post('/update-laporan/{id}', [LaporanController::class, 'update']);
    Route::delete('/hapus-laporan/{id}', [LaporanController::class, 'destroy']);
    Route::get('/export-pdf', [LaporanController::class, 'exportPdf']);
});

// ROUTE PUBLIK (BEBAS DI AKSES TANPA LOGIN)
Route::get('/lapor', [LaporanController::class, 'create']);
Route::post('/lapor', [LaporanController::class, 'store']);

// Route Lacak & Chat (Warga)
Route::get('/lacak', [LaporanController::class, 'lacakForm']);
Route::post('/kirim-chat/{id}', [LaporanController::class, 'kirimChat']);
Route::get('/api/chat/{id}', [LaporanController::class, 'fetchChat']);

// Route Lupa Tiket (Warga)
Route::post('/lupa-tiket', [LaporanController::class, 'lupaTiket']);

require __DIR__.'/auth.php';