<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Lapor Sapa - Admin Panel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-screen flex bg-gray-100 font-sans antialiased">
        
        <!-- SIDEBAR KIRI (Warna Biru Tua) -->
        <aside class="w-64 bg-sky-800 border-r border-sky-900 flex flex-col">
            <!-- Nama Sistem + Ikon -->
            <div class="h-16 flex items-center px-6 border-b border-sky-700">
                <svg class="w-8 h-8 text-sky-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="text-xl font-bold text-white tracking-wide">Lapor Sapa</span>
            </div>
            
            <!-- Menu Navigasi -->
            <nav class="flex-1 px-4 py-8 space-y-2">
                <p class="px-4 text-xs font-semibold text-sky-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <!-- Menu Dashboard -->
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-sky-600 text-white shadow-sm' : 'text-sky-100 hover:bg-sky-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Menu Data Laporan -->
                <a href="/daftar-laporan" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->path() === 'daftar-laporan' ? 'bg-sky-600 text-white shadow-sm' : 'text-sky-100 hover:bg-sky-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span>Data Laporan</span>
                </a>

                             <!-- Menu Detail Laporan -->
                <a href="/detail-laporan" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition {{ request()->path() === 'detail-laporan' ? 'bg-sky-600 text-white shadow-sm' : 'text-sky-100 hover:bg-sky-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span>Detail Laporan</span>
                </a>
            </nav>
        </aside>

        <!-- AREA KANAN (HEADER & KONTEN) -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- HEADER ATAS (Profil di Kanan) -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-end px-8 shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center font-bold text-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition p-2 rounded-full hover:bg-gray-100" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </header>
            
            <!-- KONTEN UTAMA -->
            <main class="flex-1 overflow-y-auto p-8 bg-gray-100">
                {{ $slot }}
            </main>
        </div>

    </body>
</html>