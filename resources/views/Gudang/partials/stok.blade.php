
<h3 class="text-lg font-semibold mb-4">Stok Inventory</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Gudang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($stok as $inventory)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->lokasigudang }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->namabarang }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($inventory->total_qtty, 0, ',', '.') }} Kg</td>
    </tr>
    @endforeach
    </tbody>
</table>
