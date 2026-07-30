<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Status Laporan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-4">
                        <p><strong>Judul:</strong> {{ $laporan->judul_laporan }}</p>
                        <p><strong>Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
                        <p><strong>Deskripsi:</strong> {{ $laporan->deskripsi }}</p>
                    </div>

                    <form action="/update-laporan/{{ $laporan->id }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status:</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="Diterima" @if($laporan->status == 'Diterima') selected @endif>Diterima</option>
                                <option value="Diproses" @if($laporan->status == 'Diproses') selected @endif>Diproses</option>
                                <option value="Selesai" @if($laporan->status == 'Selesai') selected @endif>Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="/daftar-laporan" class="ml-2 text-gray-600 hover:text-gray-900">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>