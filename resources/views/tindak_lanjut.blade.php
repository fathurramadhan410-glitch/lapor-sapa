<x-app-layout>
    <div class="w-full">
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Tindak Lanjut Laporan</h3>
            <p class="text-gray-500">Daftar laporan yang membutuhkan tindakan petugas.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Hari & Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Nama Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Judul Laporan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($laporans as $laporan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                            <div class="font-medium text-gray-700">{{ $laporan->created_at->locale('id')->isoFormat('dddd') }}</div>
                            {{ $laporan->created_at->locale('id')->isoFormat('D MMM Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-top">
                            {{ $laporan->nama_pelapor }}
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm font-medium text-gray-900">{{ $laporan->judul_laporan }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap align-top">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($laporan->status == 'Diterima') bg-orange-100 text-orange-800 
                                @elseif($laporan->status == 'Diproses') bg-blue-100 text-blue-800 
                                @else bg-green-100 text-green-800 @endif">
                                {{ $laporan->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center align-top">
                            <a href="/detail-laporan/{{ $laporan->id }}" class="bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold py-2 px-4 rounded-md">Tindak Lanjuti</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>