<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Tiket - Lapor Sapa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="bg-gradient-to-r from-blue-800 to-indigo-900 text-white py-8">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h1 class="text-3xl font-bold mb-2">Kode Tiket Anda</h1>
            <p class="text-blue-200">Berikut adalah laporan yang terdaftar atas nama Anda.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-6 py-10">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Hasil Pencarian</h2>
        
        @if($laporans->count() > 0)
            <div class="space-y-4">
                @foreach($laporans as $l)
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">{{ $l->judul_laporan }}</p>
                        <p class="text-sm text-gray-400">Tanggal: {{ $l->created_at->format('d M Y') }}</p>
                        <p class="text-xl font-bold font-mono text-blue-600 mt-1">{{ $l->kode_tiket }}</p>
                    </div>
                    <a href="/lacak?kode_tiket={{ $l->kode_tiket }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-lg">Buka Chat</a>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-red-50 text-red-600 p-4 rounded-lg text-center">
                Data tidak ditemukan. Pastikan Nama dan No HP sesuai saat Anda melapor.
            </div>
        @endif
        
        <div class="mt-8 text-center">
            <a href="/lacak" class="text-blue-600 hover:underline">← Kembali ke Lacak Laporan</a>
        </div>
    </div>
</body>
</html>