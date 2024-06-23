
<h3 class="text-lg font-semibold mb-4">Daftar Pembelian</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Supplier</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">harga Pembelian</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($viewpurchaselist as $purchase)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->idorder}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->tanggalorder}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->supplier->namasupplier}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->produk->namabarang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($purchase->qttyorder, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($purchase->hargapembelian, 0, ',', '.') }}</td>    
        </tr>
        @endforeach
    </tbody>
</table>

<div class="bg-white px-4 py-3 sm:px-6">
    {{ $viewpurchaselist->appends(request()->input())->links() }}
</div>