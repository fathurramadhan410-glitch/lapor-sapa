<x-app-layout>
    <div class="w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div class="mb-4 md:mb-0">
                <h3 class="text-2xl font-bold text-gray-800">Data Rekap Laporan</h3>
                <p class="text-gray-500">Rekapitulasi seluruh laporan warga yang masuk ke sistem.</p>
            </div>

            <!-- FORM FILTER & EXPORT -->
            <div class="flex flex-wrap space-x-2 items-center">
                <form action="/daftar-laporan" method="GET" class="flex space-x-2 items-center bg-white border border-gray-300 rounded-lg p-1">
                    <!-- Dropdown Bulan -->
                    <select name="bulan" class="text-sm py-1 px-2 border-none focus:ring-0 rounded-md bg-transparent">
                        <option value="">Semua Bulan</option>
                        @php
                            $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
                        @endphp
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Dropdown Tahun -->
                    <select name="tahun" class="text-sm py-1 px-2 border-none focus:ring-0 rounded-md bg-transparent">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-1 px-3 rounded-md text-sm">
                        Filter
                    </button>
                </form>

                <!-- Tombol Export PDF -->
                <a href="/export-pdf{{ request()->getQueryString() ? '?' . http_build_query(request()->query()) : '' }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export PDF
                </a>
            </div>
        </div>

        <!-- TABEL DATA -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Pelapor & Laporan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Koordinat & IP</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($laporans as $laporan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                            {{ $laporan->created_at->format('d M Y') }}<br>
                            <span class="text-xs text-gray-400">{{ $laporan->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm font-semibold text-gray-900">{{ $laporan->judul_laporan }}</div>
                            <div class="text-sm text-gray-500">Oleh: {{ $laporan->nama_pelapor }} • 📍 {{ $laporan->lokasi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap align-top">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($laporan->status == 'Diterima') bg-orange-100 text-orange-800 
                                @elseif($laporan->status == 'Diproses') bg-blue-100 text-blue-800 
                                @else bg-green-100 text-green-800 @endif">
                                {{ $laporan->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 font-mono align-top">
                            <div>Lat: {{ $laporan->latitude ?? 'N/A' }}</div>
                            <div>Lng: {{ $laporan->longitude ?? 'N/A' }}</div>
                            <div class="text-red-500 mt-1">IP: {{ $laporan->ip_address ?? 'N/A' }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>