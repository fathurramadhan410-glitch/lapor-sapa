<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    <title>Lapor Sapa - Smart City System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-slate-800">

    <!-- NAVBAR (Biru Tua Solid) -->
    <nav class="bg-blue-900 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-9 w-9 object-contain bg-white p-1 rounded-md" onerror="this.style.display='none'">
                <span class="text-xl font-extrabold text-white tracking-tight">Lapor Sapa</span>
            </div>
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-blue-100">
                <a href="#tentang" class="hover:text-white transition">Tentang</a>
                <a href="#alur" class="hover:text-white transition">Cara Kerja</a>
                <a href="#fitur" class="hover:text-white transition">Fitur</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-blue-100 hover:text-white font-medium text-sm transition">Login Admin</a>
                <a href="/lapor" class="bg-white hover:bg-blue-100 text-blue-900 font-semibold py-2.5 px-6 rounded-lg text-sm transition shadow-md">Buat Laporan</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (2 Bagian: Kiri Teks, Kanan Logo) -->
    <section class="bg-blue-50 border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-6 py-24 md:py-32 grid md:grid-cols-2 gap-12 items-center">
            
            <!-- Kiri: Teks -->
            <div class="text-center md:text-left">
                <div class="inline-block bg-white border border-blue-200 text-blue-700 text-xs font-semibold px-4 py-1.5 rounded-full mb-8 uppercase tracking-wider shadow-sm">
                    Smart City E-Government
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight text-slate-900">
                    Warga Aktif Melapor, <br> Kota Cerdas Bertindak.
                </h1>
                <p class="text-slate-600 text-lg md:text-xl mb-10 leading-relaxed font-light max-w-xl mx-auto md:mx-0">
                    Platform digital resmi yang menjembatani komunikasi warga dan pemerintah. Laporkan kerusakan infrastruktur atau gangguan lingkungan dengan cepat, akurat, dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 md:justify-start justify-center">
                    <a href="/lapor" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-4 px-8 rounded-xl text-center transition transform hover:-translate-y-1 shadow-xl flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span>Buat Laporan</span>
                    </a>
                    <a href="/lacak" class="bg-white border-2 border-slate-200 hover:border-blue-400 text-slate-800 hover:text-blue-700 font-bold py-4 px-8 rounded-xl text-center transition flex items-center justify-center space-x-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span>Lacak Status</span>
                    </a>
                </div>
            </div>

            <!-- Kanan: Foto Logo -->
            <div class="hidden md:flex justify-center items-center">
                <img src="{{ asset('logo.png') }}" alt="Logo Lapor Sapa" class="w-80 h-80 object-contain drop-shadow-2xl">
            </div>

        </div>
    </section>

    <!-- TENTANG SISTEM (Putih Bersih) -->
    <section id="tentang" class="py-20 bg-white border-b border-slate-100">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <span class="text-sm font-bold text-blue-700 uppercase tracking-wider">Tentang Sistem</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2 mb-8">Membangun Kota yang Lebih Baik, Bersama</h2>
            <div class="bg-slate-50 p-8 md:p-12 rounded-r-2xl border-l-4 border-blue-900 text-left shadow-sm">
                <p class="text-slate-700 text-lg leading-relaxed text-justify">
                    <strong class="text-slate-900">Lapor Sapa</strong> adalah inovasi digital yang mendigitalkan proses pelaporan warga. Dibangun dengan visi <span class="text-blue-700 font-semibold">Smart City</span>, sistem ini memungkinkan warga melaporkan permasalahan kota hanya dengan menggunakan ponsel mereka. Sistem secara otomatis menangkap titik koordinat (GPS) pelapor, memvalidasi laporan melalui foto bukti, dan memungkinkan komunikasi langsung antara warga dan petugas lapangan melalui fitur Live Chat yang aman.
                </p>
            </div>
        </div>
    </section>

    <!-- ALUR KERJA (Background Terang, Sama dengan Fitur) -->
    <section id="alur" class="py-20 bg-blue-50 border-y border-blue-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-sm font-bold text-blue-700 uppercase tracking-wider">Cara Kerja</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2">Alur Proses yang Cepat & Transparan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                
                <!-- Langkah 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-extrabold">1</div>
                    <h3 class="font-bold text-slate-900 mb-3 text-xl text-center">Warga Melapor</h3>
                    <p class="text-slate-600 text-sm leading-relaxed text-center">Warga mengisi form, mengunggah foto bukti, dan GPS otomatis tercatat.</p>
                </div>

                <!-- Langkah 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-orange-100 text-orange-700 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-extrabold">2</div>
                    <h3 class="font-bold text-slate-900 mb-3 text-xl text-center">Validasi Admin</h3>
                    <p class="text-slate-600 text-sm leading-relaxed text-center">Admin menerima laporan real-time, memverifikasi lokasi via peta digital.</p>
                </div>

                <!-- Langkah 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-extrabold">3</div>
                    <h3 class="font-bold text-slate-900 mb-3 text-xl text-center">Tindak Lanjut</h3>
                    <p class="text-slate-600 text-sm leading-relaxed text-center">Status diperbarui menjadi "Diproses", komunikasi via Live Chat aktif.</p>
                </div>

                <!-- Langkah 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 transform hover:-translate-y-2 transition duration-300">
                    <div class="w-14 h-14 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-extrabold">4</div>
                    <h3 class="font-bold text-slate-900 mb-3 text-xl text-center">Selesai</h3>
                    <p class="text-slate-600 text-sm leading-relaxed text-center">Masalah diselesaikan, status berubah "Selesai". Warga dapat melacak hasilnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR UNGGULAN (Sama dengan Alur Kerja: Terang, Kartu Putih) -->
    <section id="fitur" class="py-20 bg-blue-50 border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-sm font-bold text-blue-700 uppercase tracking-wider">Fitur Unggulan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2">Teknologi yang Memudahkan Siapapun</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Fitur 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-700 group-hover:text-white transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2 text-lg">Geolocation Otomatis</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Titik koordinat (Latitude & Longitude) pelapor tercatat otomatis untuk akurasi maksimal.</p>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                    <div class="w-14 h-14 bg-green-100 text-green-700 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-700 group-hover:text-white transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2 text-lg">Rekap & Cetak PDF</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Admin dapat memfilter data per periode dan mencetak laporan PDF profesional.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                    <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center mb-6 group-hover:bg-purple-700 group-hover:text-white transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2 text-lg">Live Chat Real-time</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Komunikasi langsung warga-petugas melalui sistem Kode Tiket yang aman tanpa refresh.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                    <div class="w-14 h-14 bg-red-100 text-red-700 rounded-xl flex items-center justify-center mb-6 group-hover:bg-red-700 group-hover:text-white transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2 text-lg">Keamanan Berlapis</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Setiap laporan mencatat IP Address pelapor untuk mitigasi laporan fiktif/spam.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SIAP MENJADI BAGIAN (Putih Polos, Informatif) -->
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-slate-50 rounded-3xl p-10 md:p-16 border border-slate-100 shadow-sm text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6 text-slate-900">Siap Menjadi Bagian dari Kota Cerdas?</h2>
                <p class="text-slate-600 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                    Suaramu sangat berarti bagi kemajuan kota kita. Melalui Lapor Sapa, setiap keluhan Anda akan didengar, diproses, dan ditindaklanjuti dengan transparan. Mari bersama-sama menciptakan lingkungan kota yang lebih baik, aman, dan nyaman bagi seluruh warga.
                </p>
                
                <!-- Poin Informatif -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10 text-left">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Proses Cepat</h4>
                            <p class="text-sm text-slate-500">Laporan langsung diterima admin tanpa birokrasi berlapis.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Data Akurat</h4>
                            <p class="text-sm text-slate-500">Lokasi otomatis dan foto bukti memastikan data valid.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Transparan</h4>
                            <p class="text-sm text-slate-500">Pantau status laporan Anda secara real-time hingga selesai.</p>
                        </div>
                    </div>
                </div>

                <a href="/lapor" class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-bold py-4 px-10 rounded-xl text-lg transition transform hover:-translate-y-1 shadow-xl">
                    Mulai Buat Laporan
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER (Sama dengan Header: Biru Tua Solid) -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-8 object-contain bg-white p-1 rounded-md" onerror="this.style.display='none'">
                    <span class="text-xl font-bold">Lapor Sapa</span>
                </div>
                <p class="text-blue-200 text-sm leading-relaxed">Sistem Pelaporan Infrastruktur & Gangguan Kota Cerdas.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm text-blue-200">
                    <li><a href="#tentang" class="hover:text-white transition">Tentang Sistem</a></li>
                    <li><a href="/lapor" class="hover:text-white transition">Buat Laporan</a></li>
                    <li><a href="/lacak" class="hover:text-white transition">Lacak Laporan</a></li>
                    <li><a href="/login" class="hover:text-white transition">Login Admin</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Kantor Pemerintahan</h4>
                <p class="text-blue-200 text-sm">Jl. Pemerintahan No. 1, Kota Cerdas, Indonesia.</p>
                <p class="text-blue-200 text-sm mt-2">Email: admin@laporsapa.go.id</p>
            </div>
        </div>
        <div class="border-t border-blue-800 mt-10 pt-6 text-center text-blue-300 text-sm">
            &copy; 2024 Lapor Sapa - Smart City System. Dibangun dengan Laravel & Tailwind CSS.
        </div>
    </footer>

</body>
</html>