
<h3 class="text-lg font-semibold mb-4">Daftar Produksi</h3>
<table class="min-w-full divide-y divide-gray-200">
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
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tanggalproduksi}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ 'Rp ' . number_format($jadwal->biayaproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->produk->namabarang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($jadwal->qttyproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->status}}</td>
            </tr>
        @endforeach
    </tbody>
</table>