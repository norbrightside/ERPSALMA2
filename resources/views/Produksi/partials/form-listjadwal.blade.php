
<h3 class="text-lg font-semibold mb-4">Daftar Produksi</h3>
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
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tanggalproduksi}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ 'Rp ' . number_format($jadwal->biayaproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->produk->namabarang}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($jadwal->qttyproduksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->status}}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form action="{{ route('produksi.updateStatus', $jadwal->idproduksi) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()">
                        <option value="Preproduksi" {{ $jadwal->status == 'Preproduksi' ? 'selected' : '' }}>Preproduksi</option>
                        <option value="produksi" {{ $jadwal->status == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                        <option value="Selesai"  {{ $jadwal->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <!-- Tambahkan status lain jika diperlukan -->
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