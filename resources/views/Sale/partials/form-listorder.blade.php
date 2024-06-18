
<h3 class="text-lg font-semibold mb-4">Daftar Penjualan</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Faktur</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Transaksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($viewsales as $sales)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->nofak}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->tanggal}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->pelanggan->namapelanggan}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->produk->namabarang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->nilaitransaksi, 0, ',', '.')}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->qttypenjualan, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>