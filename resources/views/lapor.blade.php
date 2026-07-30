<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - Lapor Sapa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 font-sans antialiased text-slate-800">

    <!-- NAVBAR (Biru Tua Solid) -->
    <nav class="bg-blue-900 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-9 w-9 object-contain bg-white p-1 rounded-md" onerror="this.style.display='none'">
                <span class="text-xl font-extrabold text-white tracking-tight">Lapor Sapa</span>
            </div>
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-blue-100">
                <a href="/#tentang" class="hover:text-white transition">Tentang</a>
                <a href="/#alur" class="hover:text-white transition">Cara Kerja</a>
                <a href="/#fitur" class="hover:text-white transition">Fitur</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-blue-100 hover:text-white font-medium text-sm transition">Login Admin</a>
                <a href="/lacak" class="bg-white hover:bg-blue-100 text-blue-900 font-semibold py-2.5 px-6 rounded-lg text-sm transition shadow-md">Lacak Laporan</a>
            </div>
        </div>
    </nav>

    <!-- BANNER INFORMATIF -->
    <div class="bg-blue-50 border-b border-blue-100 py-10 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3">Buat Laporan Baru</h1>
            <p class="text-slate-600 text-lg">Suaramu sangat berarti. Isi formulir di bawah ini dengan data yang sebenarnya. Sistem akan otomatis mencatat lokasi Anda untuk akurasi penanganan.</p>
        </div>
    </div>

    <!-- FORM SECTION -->
    <div class="flex-1 w-full max-w-3xl mx-auto px-6 py-12">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 border-t-8 border-blue-900">
            
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded flex items-center" role="alert">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="/lapor" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <input type="hidden" name="latitude" id="latitude" value="">
                <input type="hidden" name="longitude" id="longitude" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama_pelapor" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" id="no_hp" name="no_hp" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="0812xxxxxxx">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                        <input type="text" id="judul" name="judul_laporan" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Cth: Lampu Jalan Mati">
                    </div>
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian</label>
                        <input type="text" id="lokasi" name="lokasi" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Cth: Jl. Merdeka No. 10">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Detail</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan kondisi atau masalah..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Bukti <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8a4 4 0 01-4-4V8a4 4 0 014-4h16l8 8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload file</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/*" required>
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG sampai 2MB</p>
                        </div>
                    </div>
                </div>

                <div id="gps-status" class="mb-4 text-sm text-gray-500 bg-gray-100 p-3 rounded-lg flex items-center">
                    <svg class="animate-spin h-5 w-5 mr-3 text-blue-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="gps-text">Mencari sinyal GPS Anda...</span>
                </div>

                <div class="pt-2">
                    <button type="submit" id="submit-btn" disabled class="w-full bg-gray-400 text-white font-bold py-3 px-4 rounded-lg shadow-md cursor-not-allowed opacity-50">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
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
                    <li><a href="/" class="hover:text-white transition">Tentang Sistem</a></li>
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

    <!-- Script Notif Pop-up Warga -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#1e3a8a'
        }).then(() => {
            window.location.href = '/lacak?kode_tiket={{ session('kode_tiket') }}';
        });
    </script>
    @endif

    <script>
        const submitBtn = document.getElementById('submit-btn');
        const gpsStatus = document.getElementById('gps-status');
        const gpsText = document.getElementById('gps-text');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    gpsText.textContent = "Lokasi GPS berhasil ditemukan! 📍";
                    gpsStatus.classList.remove('text-gray-500', 'bg-gray-100');
                    gpsStatus.classList.add('text-green-700', 'bg-green-100');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed', 'opacity-50');
                    submitBtn.classList.add('bg-blue-900', 'hover:bg-blue-800');
                },
                function(error) {
                    gpsText.textContent = "Gagal mendapatkan lokasi. Pastikan GPS aktif & diizinkan.";
                    gpsStatus.classList.remove('text-gray-500', 'bg-gray-100');
                    gpsStatus.classList.add('text-red-700', 'bg-red-100');
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }
    </script>
</body>
</html>