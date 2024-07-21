<h3 class="text-lg font-semibold mb-4">Daftar Penjualan</h3>

<!-- Filter Form -->
<form action="{{ route('viewsales') }}" method="post" class="mb-4">
    <div class="flex flex-wrap gap-4">
        <div class="w-full md:w-1/5">
            <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan:</label>
            <select name="bulan" id="bulan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
        <div class="w-full md:w-1/5">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun:</label>
            <select name="tahun" id="tahun" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua</option>
                @foreach (range(date('Y'), date('Y') - 10) as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/5">
            <label for="idpelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan:</label>
            <select name="idpelanggan" id="idpelanggan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua</option>
                @foreach ($pelanggan as $item)
                    <option value="{{ $item->idpelanggan }}" {{ request('idpelanggan') == $item->idpelanggan ? 'selected' : '' }}>{{ $item->namapelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/5">
            <label for="idbarang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <select name="idbarang" id="idbarang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->idbarang }}" {{ request('idbarang') == $item->idbarang ? 'selected' : '' }}>{{ $item->namabarang }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/5">
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua</option>
                <option value="Order Baru" {{ request('status') == 'Order Baru' ? 'selected' : '' }}>Order Baru</option>
                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Pengiriman" {{ request('status') == 'Pengiriman' ? 'selected' : '' }}>Pengiriman</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="w-full md:w-auto flex items-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black-700 bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white-500">
                Terapkan Filter
            </button>
        </div>
    </div>
    
</form>

<!-- Table to display sales data -->
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
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Update Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cetak</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($viewsales as $sales)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->nofak }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->tanggalpenjualan }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->pelanggan->namapelanggan }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->produk->namabarang }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->nilaitransaksi, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->qttypenjualan, 0, ',', '.') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sales->status }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form action="{{ route('sales.updateStatus', $sales->nofak) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()">
                        <option>Status</option>
                        <option value="Order Baru" {{ $sales->status == 'Order Baru' ? 'selected' : '' }}>Order Baru</option>
                        <option value="Lunas" {{ $sales->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Pengiriman" {{ $sales->status == 'Pengiriman' ? 'selected' : '' }}>Pengiriman</option>
                        <option value="Selesai" {{ $sales->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
            </td>
            <td class="px-6 py-4">
                <button class="bg-green-500 text-white px-2 py-1 rounded">
                    <a href="{{ route('formcetakfakturpenjualan', ['id' => $sales->nofak]) }}" class="text-white hover:underline">Cetak</a>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="bg-white px-4 py-3 sm:px-6">
    {{ $viewsales->appends(request()->input())->links() }}
</div>
