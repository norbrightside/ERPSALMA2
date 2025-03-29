
<h3 class="text-lg font-semibold mb-4">Total Stok Inventory</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($totalByProduct as $namabarang => $totalQty)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap"><strong>Total {{ $namabarang }} </strong></td>
                <td class="px-6 py-4 whitespace-nowrap"><strong>{{ number_format($totalQty, 0, ',', '.') }} Kg</strong></td>
            </tr>
            @endforeach
    </tbody>
</table>
