<x-app-layout>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="w-full">
        <div class="mb-6">
            <a href="/detail-laporan" class="text-sky-600 hover:text-sky-800 text-sm font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Tindak Lanjut
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- KOLOM KIRI -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Info Dasar -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $laporan->judul_laporan }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Dilaporkan oleh: <span class="font-semibold text-gray-700">{{ $laporan->nama_pelapor }}</span></p>
                            <p class="text-sm text-gray-500">No. Telepon: <span class="font-semibold text-gray-700">{{ $laporan->no_hp ?? '-' }}</span></p>
                            <p class="text-sm text-gray-500">Kode Tiket: <span class="font-mono font-bold text-blue-600">{{ $laporan->kode_tiket }}</span></p>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full 
                            @if($laporan->status == 'Diterima') bg-orange-100 text-orange-700 
                            @elseif($laporan->status == 'Diproses') bg-blue-100 text-blue-700 
                            @else bg-green-100 text-green-700 @endif">
                            {{ $laporan->status }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-bold text-gray-600 uppercase mb-1">Deskripsi</h4>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $laporan->deskripsi }}</p>
                    </div>

                    <!-- BAGIAN FOTO BUKTI (DIPERBESAR) -->
                    @if($laporan->foto)
                    <div>
                        <h4 class="text-sm font-bold text-gray-600 uppercase mb-2">Foto Bukti Pelapor</h4>
                        <img src="{{ asset('uploads/' . $laporan->foto) }}" class="w-full max-w-lg rounded-lg shadow-md border border-gray-200 object-cover" alt="Foto Bukti">
                    </div>
                    @else
                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500 text-sm">
                        Tidak ada foto bukti yang diunggah.
                    </div>
                    @endif
                </div>

                <!-- Peta Lokasi -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-1">Titik Koordinat Pelapor</h4>
                    <div id="map-detail" class="w-full h-80 rounded-lg border border-gray-200"></div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                        <div class="bg-sky-50 p-3 rounded-lg">
                            <p class="text-sky-600 font-bold">Latitude</p>
                            <p class="text-gray-700 font-mono">{{ $laporan->latitude ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-sky-50 p-3 rounded-lg">
                            <p class="text-sky-600 font-bold">Longitude</p>
                            <p class="text-gray-700 font-mono">{{ $laporan->longitude ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg col-span-2">
                            <p class="text-red-600 font-bold">IP Address Pelapor</p>
                            <p class="text-gray-700 font-mono">{{ $laporan->ip_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Aksi Petugas</h4>
                    <form id="status-form" action="/update-laporan/{{ $laporan->id }}" method="POST" class="mb-4">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Status:</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-3">
                            <option value="Diterima" @if($laporan->status == 'Diterima') selected @endif>Diterima</option>
                            <option value="Diproses" @if($laporan->status == 'Diproses') selected @endif>Diproses</option>
                            <option value="Selesai" @if($laporan->status == 'Selesai') selected @endif>Selesai</option>
                        </select>
                        <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 rounded-lg">Simpan Status</button>
                    </form>

                    <a href="tel:{{ $laporan->no_hp }}" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg flex items-center justify-center space-x-2 mt-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>Telepon {{ $laporan->no_hp ?? 'Warga' }}</span>
                    </a>
                </div>

                <!-- CHAT ADMIN -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Live Chat dengan Pelapor</h4>
                    <style>
                        .chat-bg-admin { background-color: #e5edf5; background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 16px 16px; }
                    </style>
                    <div id="chat-box-admin" class="chat-bg-admin flex-1 space-y-3 mb-4 max-h-96 overflow-y-auto p-4 rounded-lg"></div>
                    <form id="chat-form-admin" class="flex gap-2">
                        <input type="hidden" id="pengirim-admin" value="Admin">
                        <input type="text" id="pesan-input-admin" required class="flex-1 px-4 py-2 border border-gray-300 rounded-lg" placeholder="Tulis balasan...">
                        <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded-lg font-bold">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT NOTIF POP-UP ADMIN -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#0284c7'
        });
    </script>
    @endif

    <!-- SCRIPT PETA & CHAT -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map-detail').setView([{{ $laporan->latitude ?? -2.5489 }}, {{ $laporan->longitude ?? 118.0149 }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
        const lat = parseFloat('{{ $laporan->latitude }}');
        const lon = parseFloat('{{ $laporan->longitude }}');
        if(!isNaN(lat) && !isNaN(lon)) {
            L.marker([lat, lon]).addTo(map).bindPopup('<b>Lokasi Pelapor:</b><br>{{ $laporan->nama_pelapor }}').openPopup();
        }
    </script>
    <script>
        const laporanIdAdmin = "{{ $laporan->id }}";
        const chatBoxAdmin = document.getElementById('chat-box-admin');
        const chatFormAdmin = document.getElementById('chat-form-admin');
        const pesanInputAdmin = document.getElementById('pesan-input-admin');
        const pengirimAdmin = document.getElementById('pengirim-admin').value;

        function fetchChatAdmin() {
            fetch(`/api/chat/${laporanIdAdmin}`).then(res => res.json()).then(data => {
                chatBoxAdmin.innerHTML = '';
                data.forEach(chat => {
                    const isRight = chat.pengirim === pengirimAdmin;
                    const bubble = `
                        <div class="flex ${isRight ? 'justify-end' : 'justify-start'}">
                            <div class="max-w-xs ${isRight ? 'bg-sky-600 text-white' : 'bg-white border text-gray-800'} px-4 py-2 rounded-lg shadow-sm">
                                <p class="text-xs font-bold ${isRight ? 'text-sky-200' : 'text-gray-500'} mb-1">${chat.nama}</p>
                                <p class="text-sm">${chat.pesan}</p>
                                <p class="text-xs ${isRight ? 'text-sky-200' : 'text-gray-400'} mt-1 text-right">${chat.waktu}</p>
                            </div>
                        </div>`;
                    chatBoxAdmin.innerHTML += bubble;
                });
                chatBoxAdmin.scrollTop = chatBoxAdmin.scrollHeight;
            });
        }

        chatFormAdmin.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('pengirim', pengirimAdmin);
            formData.append('pesan', pesanInputAdmin.value);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(`/kirim-chat/${laporanIdAdmin}`, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') { pesanInputAdmin.value = ''; fetchChatAdmin(); }
            });
        });

        setInterval(fetchChatAdmin, 2000);
        fetchChatAdmin();
    </script>
</x-app-layout>