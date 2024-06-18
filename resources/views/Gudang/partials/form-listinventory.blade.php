
<h3 class="text-lg font-semibold mb-4">Daftar Inventory</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Gudang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty Produksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($viewinventory as $inventory)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->idgudang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->tanggal}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->produk->namabarang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($inventory->qtty, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>