<!-- list-stokavailable.blade.php -->
<h3 class="text-lg font-semibold mb-4">Stok Tersedia</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Gudang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Tersedia</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($availableStocks as $stock)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->idbarang }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->lokasigudang }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($stock->total_qty, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
