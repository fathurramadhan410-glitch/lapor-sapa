<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Laporan - Lapor Sapa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .chat-bg {
            background-color: #e5edf5;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 16px 16px;
        }
    </style>
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
                <a href="/lapor" class="bg-white hover:bg-blue-100 text-blue-900 font-semibold py-2.5 px-6 rounded-lg text-sm transition shadow-md">Buat Laporan</a>
            </div>
        </div>
    </nav>

    <!-- BANNER INFORMATIF -->
    <div class="bg-blue-50 border-b border-blue-100 py-10 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3">Lacak & Tindak Lanjut Laporan</h1>
            <p class="text-slate-600 text-lg">Pantau status laporan Anda dan berkomunikasi langsung dengan petugas melalui Live Chat. Masukkan Kode Tiket yang Anda dapatkan saat melapor.</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 w-full max-w-3xl mx-auto px-6 py-12">
        
        <!-- Form Lacak -->
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 mb-8">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Masukkan Kode Tiket</h3>
            <form action="/lacak" method="GET" class="flex gap-2 mb-6">
                <input type="text" name="kode_tiket" required value="{{ request('kode_tiket') }}" class="flex-1 px-4 py-3 border border-slate-300 rounded-lg uppercase focus:ring-2 focus:ring-blue-500" placeholder="LPR-XXXXXX">
                <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-bold px-6 rounded-lg">Cek</button>
            </form>

            <!-- Form Lupa Tiket -->
            <div class="border-t border-slate-100 pt-6">
                <p class="text-sm font-bold text-slate-700 mb-3">Lupa Kode Tiket?</p>
                <form action="/lupa-tiket" method="POST" class="flex flex-wrap gap-2 items-end">
                    @csrf
                    <div class="flex-1 min-w-[150px]">
                        <label class="text-xs text-slate-500">Nama</label>
                        <input type="text" name="nama_pelapor" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md">
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label class="text-xs text-slate-500">No HP</label>
                        <input type="text" name="no_hp" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md">
                    </div>
                    <button type="submit" class="bg-slate-200 text-slate-700 text-sm font-bold py-2 px-4 rounded-md">Cari Tiket</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif

        @if ($laporan)
            <!-- KARTU LAPORAN DITEMUKAN -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-900 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-xl text-slate-900">{{ $laporan->judul_laporan }}</h3>
                        <p class="text-sm text-slate-500 mt-1">Dilaporkan oleh: <span class="font-semibold">{{ $laporan->nama_pelapor }}</span></p>
                        <p class="text-sm text-slate-500">Lokasi: <span class="font-semibold">{{ $laporan->lokasi }}</span></p>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                        @if($laporan->status == 'Diterima') bg-orange-100 text-orange-700 
                        @elseif($laporan->status == 'Diproses') bg-blue-100 text-blue-700 
                        @else bg-green-100 text-green-700 @endif">
                        {{ $laporan->status }}
                    </span>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-sm text-slate-600"><strong>Deskripsi:</strong> {{ $laporan->deskripsi }}</p>
                </div>
            </div>

            <!-- KOTAK CHAT -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100">
                <div class="bg-blue-900 text-white px-6 py-4 font-bold flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <span>Live Chat dengan Petugas</span>
                </div>
                
                <div id="chat-box" class="chat-bg h-96 overflow-y-auto p-4 space-y-4"></div>

                <form id="chat-form" class="p-4 bg-white border-t flex gap-2">
                    <input type="hidden" id="pengirim" value="Warga">
                    <input type="text" id="pesan-input" required class="flex-1 px-4 py-2 border border-slate-300 rounded-lg" placeholder="Tulis pesan...">
                    <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-800 transition">Kirim</button>
                </form>
            </div>
        @elseif (request()->has('kode_tiket'))
            <div class="bg-red-50 text-red-600 p-6 rounded-lg text-center border border-red-100">
                <p class="font-bold">Kode tiket tidak ditemukan.</p>
                <p class="text-sm mt-2">Pastikan Anda mengetik Kode Tiket dengan benar (huruf besar/kecil berpengaruh).</p>
            </div>
        @else
            <!-- INFO KOSONG AGAR TIDAK POLOS -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 text-center">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-lg font-bold text-slate-700 mb-2">Mulai Melacak</h3>
                <p class="text-slate-500 text-sm max-w-md mx-auto">Masukkan Kode Tiket Anda di atas untuk melihat status laporan dan memulai chat dengan petugas lapangan.</p>
            </div>
        @endif
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

    <script>
        const laporanId = "{{ $laporan->id ?? null }}";
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const pesanInput = document.getElementById('pesan-input');
        const pengirim = document.getElementById('pengirim').value;

        function fetchChat() {
            if(!laporanId) return;
            fetch(`/api/chat/${laporanId}`)
                .then(res => res.json())
                .then(data => {
                    chatBox.innerHTML = '';
                    data.forEach(chat => {
                        const isRight = chat.pengirim === pengirim;
                        const bubble = `
                            <div class="flex ${isRight ? 'justify-end' : 'justify-start'}">
                                <div class="max-w-xs ${isRight ? 'bg-blue-900 text-white' : 'bg-white border text-slate-800'} px-4 py-2 rounded-lg shadow-sm">
                                    <p class="text-xs font-bold ${isRight ? 'text-blue-200' : 'text-slate-500'} mb-1">${chat.nama}</p>
                                    <p class="text-sm">${chat.pesan}</p>
                                    <p class="text-xs ${isRight ? 'text-blue-200' : 'text-slate-400'} mt-1 text-right">${chat.waktu}</p>
                                </div>
                            </div>
                        `;
                        chatBox.innerHTML += bubble;
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if(!laporanId) return;
            
            const formData = new FormData();
            formData.append('pengirim', pengirim);
            formData.append('pesan', pesanInput.value);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(`/kirim-chat/${laporanId}`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    pesanInput.value = '';
                    fetchChat();
                } else {
                    alert('Gagal mengirim pesan.');
                }
            })
            .catch(err => alert('Error: ' + err));
        });

        if(laporanId) {
            setInterval(fetchChat, 2000);
            fetchChat();
        }
    </script>
</body>
</html>