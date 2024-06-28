
<h3 class="text-lg font-semibold mb-4">Laporan Penjualan</h3>
<form action="{{ route('viewsales') }}" method="GET">
    <label for="bulan">Pilih Bulan:</label>
    <select name="bulan" id="bulan">
        <option value="">-- Pilih Bulan --</option>
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
        <!-- Tambahkan opsi bulan lainnya sesuai kebutuhan -->
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Table to display sales data -->

    <table class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <!-- Table Header -->
        <thead class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($laporan as $sales)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->nofak }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->tanggalpenjualan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->pelanggan->namapelanggan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->produk->namabarang }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->nilaitransaksi, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->qttypenjualan, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->status }}</td>
            </tr>
            @endforeach
        </tbody>
        @if ($laporan->total() > 0)
            <tfoot>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</td>
                    <td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ number_format($laporan->sum('nilaitransaksi'), 0, ',', '.') }}
                    </td>
                    <td colspan="6"></td>
                </tr>
            </tfoot>
            @endif
    </table>


<!-- Pagination Links -->
@if ($viewsales->total() > 15)
    <div class="bg-white px-4 py-3 sm:px-6">
        {{ $viewsales->appends(request()->input())->links() }}
    </div>
@endif