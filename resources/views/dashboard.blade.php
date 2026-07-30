<x-app-layout>
    <div class="w-full">
        
        <!-- Header Info Waktu -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Dashboard Admin</h3>
                <p class="text-gray-500">Ringkasan sistem pelaporan warga hari ini.</p>
            </div>
            <div class="bg-white shadow-sm rounded-lg px-6 py-3 mt-4 md:mt-0 text-right border-l-4 border-sky-600">
                <p id="current-day" class="text-sm text-gray-500 font-medium uppercase tracking-wider"></p>
                <p id="current-date" class="text-md font-bold text-gray-700"></p>
                <p id="current-time" class="text-2xl font-mono font-bold text-sky-700 mt-1"></p>
            </div>
        </div>

        <!-- Grid Kartu Statistik Berwarna -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl shadow-lg p-6">
                <p class="text-sm font-medium uppercase tracking-wider opacity-80">Total Laporan</p>
                <p class="text-4xl font-bold mt-2">{{ $totalLaporan }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 text-white rounded-xl shadow-lg p-6">
                <p class="text-sm font-medium uppercase tracking-wider opacity-80">Laporan Baru</p>
                <p class="text-4xl font-bold mt-2">{{ $laporanBaru }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-indigo-600 text-white rounded-xl shadow-lg p-6">
                <p class="text-sm font-medium uppercase tracking-wider opacity-80">Sedang Diproses</p>
                <p class="text-4xl font-bold mt-2">{{ $laporanDiproses }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 text-white rounded-xl shadow-lg p-6">
                <p class="text-sm font-medium uppercase tracking-wider opacity-80">Selesai</p>
                <p class="text-4xl font-bold mt-2">{{ $laporanSelesai }}</p>
            </div>
        </div>

        <!-- BAGIAN PETA SMART CITY -->
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6 mb-8">
            <h4 class="text-lg font-bold text-gray-800 mb-1">Peta Sebaran Laporan Warga</h4>
            <p class="text-gray-500 text-sm mb-4">Titik koordinat otomatis dari pelapor. Warna marker menandakan status.</p>
            
            <div id="map" class="w-full h-96 rounded-lg border border-gray-200 z-0"></div>
        </div>

    </div>

    <!-- SCRIPT LEAFLET.JS UNTUK MAPS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        // 1. Jam Real-Time
        function updateTime() {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const now = new Date();
            
            document.getElementById('current-day').textContent = days[now.getDay()];
            document.getElementById('current-date').textContent = now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
        }
        setInterval(updateTime, 1000);
        updateTime();

        // 2. Inisialisasi Peta Leaflet
        const map = L.map('map').setView([-2.5489, 118.0149], 5); // Default view Indonesia

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 3. Ambil Data dari Laravel & Tampilkan Marker
        const laporanData = @json($mapLaporans);
        
        // Warna Marker berdasarkan status
        const statusColors = {
            'Diterima': 'orange',
            'Diproses': 'blue',
            'Selesai': 'green'
        };

        laporanData.forEach(function(laporan) {
            const lat = parseFloat(laporan.latitude);
            const lon = parseFloat(laporan.longitude);
            
            if(!isNaN(lat) && !isNaN(lon)) {
                // Bikin ikon pin warna warni
                const icon = L.divIcon({
                    className: 'custom-marker',
                    html: `<div style="background-color: ${statusColors[laporan.status] || 'gray'}; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.5);"></div>`,
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });

                // Tambahkan marker ke peta
                const marker = L.marker([lat, lon], { icon: icon }).addTo(map);
                
                // Popup deskripsi
                marker.bindPopup(`
                    <div style="min-width: 150px;">
                        <strong>${laporan.judul_laporan}</strong><br>
                        <small>Pelapor: ${laporan.nama_pelapor}</small><br>
                        <small>Lokasi: ${laporan.lokasi}</small><br>
                        <span style="display:inline-block; margin-top:5px; padding:2px 6px; border-radius:4px; font-size:10px; font-weight:bold; color:white; background-color:${statusColors[laporan.status] || 'gray'};">
                            ${laporan.status}
                        </span>
                    </div>
                `);
            }
        });
    </script>
</x-app-layout>