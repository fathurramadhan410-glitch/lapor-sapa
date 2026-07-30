<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Lapor Sapa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex bg-slate-50 font-sans antialiased">

    <!-- BAGIAN KIRI (Wallpaper & Logo) -->
    <div class="hidden md:flex md:w-1/2 bg-blue-900 items-center justify-center relative overflow-hidden">
        <!-- Pattern Background -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="relative text-center px-8">
            <img src="{{ asset('logo.png') }}" alt="Logo Lapor Sapa" class="w-48 h-48 mx-auto mb-8 bg-white p-4 rounded-3xl shadow-2xl object-contain" onerror="this.style.display='none'">
            <h1 class="text-4xl font-extrabold text-white tracking-tight mb-3">Lapor Sapa</h1>
            <p class="text-blue-200 text-lg font-light">Smart City E-Government System</p>
            <div class="mt-8 inline-block bg-white/10 backdrop-blur-sm border border-white/20 text-blue-100 text-xs font-semibold px-4 py-2 rounded-full uppercase tracking-wider">
                Portal Resmi Petugas & Admin
            </div>
        </div>
    </div>

    <!-- BAGIAN KANAN (Form Login) -->
    <!-- Tambahkan overflow-y-auto agar bisa di-scroll jika layar kecil -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 bg-white overflow-y-auto">
        <div class="w-full max-w-md my-10">
            
            <!-- Tombol Kembali -->
            <a href="/" class="text-sm text-slate-500 hover:text-blue-700 font-medium mb-8 inline-flex items-center transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-slate-500">Silakan masuk untuk mengakses dashboard admin.</p>
            </div>

            <!-- Notifikasi Error (Disembunyikan, ditangkap SweetAlert) -->
            @if ($errors->any())
                <input type="hidden" id="login-error" value="Email atau Password yang Anda masukkan salah. Silakan coba lagi.">
            @endif

            <form method="POST" action="{{ route('login') }}" id="login-form" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-lg text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="admin@laporsapa.go.id">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-lg text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="••••••••">
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="ms-2 text-sm text-slate-600">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3.5 rounded-lg shadow-lg transition transform hover:-translate-y-0.5 flex justify-center items-center">
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Script Notif Pop-up -->
    <script>
        // 1. Cek jika ada error dari Laravel (Email/Password salah)
        const errorMessage = document.getElementById('login-error');
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: errorMessage.value,
                confirmButtonColor: '#1e3a8a'
            });
        }

        // 2. Saat form diklik submit, tampilkan pop-up Loading (Agar user tahu sistem sedang memproses)
        document.getElementById('login-form').addEventListener('submit', function(e) {
            Swal.fire({
                title: 'Sedang Memproses...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading() }
            });
        });
    </script>
</body>
</html>