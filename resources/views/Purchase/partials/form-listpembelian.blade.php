<h3 class="text-lg font-semibold mb-4">Daftar Pembelian</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Filter Form -->
<form action="{{ route('viewpurchaselist') }}" method="post" class="mb-4">
    <div class="flex flex-wrap gap-4">
        <div class="w-full md:w-1/5">
            <label for="tanggalorder" class="block text-sm font-medium text-gray-700">Tanggal Order:</label>
            <input type="date" name="tanggalorder" id="tanggalorder" value="{{ request('tanggalorder') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="idsupplier" class="block text-sm font-medium text-gray-700">Nama Supplier:</label>
            <select name="idsupplier" id="idsupplier" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Supplier</option>
                @foreach ($supplier as $item)
                    <option value="{{ $item->idsupplier }}" {{ request('idsupplier') == $item->idsupplier ? 'selected' : '' }}>{{ $item->namasupplier }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="idbarang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <select name="idbarang" id="idbarang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Barang</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->idbarang }}" {{ request('idbarang') == $item->idbarang ? 'selected' : '' }}>{{ $item->namabarang }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Status</option>
                <option value="pemesanan baru" {{ request('status') == 'order baru' ? 'selected' : '' }}>Pemesanan Baru</option>
                <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <!-- Tambahkan status lain jika diperlukan -->
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Terapkan Filter
            </button>
        </div>
    </div>
</form>

<!-- Table to display purchase data -->
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Supplier</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty Order</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Pembelian</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cetak</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($viewpurchaselist as $purchase)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->idorder }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->tanggalorder }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->supplier->namasupplier }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->produk->namabarang }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($purchase->qttyorder, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($purchase->harga, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->status }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('pembelian.updateStatus', $purchase->idorder) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option>Status</option>
                            <option value="dibayar" {{ $purchase->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="diterima" {{ $purchase->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <button class="bg-green-500 text-white px-2 py-1 rounded">
                        <a href="{{ route('formcetakfaktur', ['id' => $purchase->idorder]) }}" class="text-white hover:underline">Cetak</a>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="bg-white px-4 py-3 sm:px-6">
    {{ $viewpurchaselist->appends(request()->input())->links() }}
</div>
