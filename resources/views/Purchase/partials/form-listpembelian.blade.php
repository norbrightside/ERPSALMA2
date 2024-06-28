<!-- resources/views/Purchase/partials/form-listpembelian.blade.php -->

<h3 class="text-lg font-semibold mb-4">Daftar Pembelian</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($purchase->hargapembelian, 0, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->status }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('pembelian.updateStatus', $purchase->idorder) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option  >Status</option>
                            <option value="dibayar" {{ $purchase->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="diterima" {{ $purchase->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <!-- Tambahkan status lain jika diperlukan -->
                        </select>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="bg-white px-4 py-3 sm:px-6">
    {{ $viewpurchaselist->appends(request()->input())->links() }}
</div>
