<h3 class="text-lg font-semibold mb-4">Daftar Produksi</h3>

<!-- Filter Form -->
<form action="{{ route('jadwalProduksi') }}" method="post" class="mb-4">
    <div class="flex flex-wrap gap-4">
        <div class="w-full md:w-1/5">
            <label for="tanggalproduksi" class="block text-sm font-medium text-gray-700">Tanggal Produksi:</label>
            <input type="date" name="tanggalproduksi" id="tanggalproduksi" value="{{ request('tanggalproduksi') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="idbarang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <select name="idbarang" id="idbarang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Barang</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->idbarang }}" {{ request('idbarang') == $item->idbarang ? 'selected' : '' }}>{{ $item->namabarang }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Status</option>
                <option value="Preproduksi" {{ request('status') == 'Preproduksi' ? 'selected' : '' }}>Preproduksi</option>
                <option value="Produksi" {{ request('status') == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Terapkan Filter
            </button>
        </div>
    </div>
</form>

<!-- Table to display production data -->
<table class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Produksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Produksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty Produksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($jadwalProduksi as $jadwal)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tanggalproduksi }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ 'Rp ' . number_format($jadwal->biayaproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->produk->namabarang }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($jadwal->qttyproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->status }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form action="{{ route('produksi.updateStatus', $jadwal->idproduksi) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()">
                        <option value="Preproduksi" {{ $jadwal->status == 'Preproduksi' ? 'selected' : '' }}>Preproduksi</option>
                        <option value="Produksi" {{ $jadwal->status == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                        <option value="Selesai" {{ $jadwal->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="bg-white px-4 py-3 sm:px-6">
    {{ $jadwalProduksi->appends(request()->input())->links() }}
</div>
