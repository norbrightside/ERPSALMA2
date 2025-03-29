<h3 class="text-lg font-semibold mb-4">Daftar Inventory</h3>

{{-- Filter Form --}}
<form action="{{ route('viewinventory') }}" method="GET" class="mb-4">
    <div class="flex space-x-4">
        <div>
            <label for="lokasigudang" class="block text-sm font-medium text-gray-700">Lokasi Gudang:</label>
            <select name="lokasigudang" id="lokasigudang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Lokasi</option>
                @foreach ($gudang as $item)
                    <option value="{{ $item->lokasigudang }}" {{ request('lokasigudang') == $item->lokasigudang ? 'selected' : '' }}>{{ $item->lokasigudang }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="namabarang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <select name="namabarang" id="namabarang" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Barang</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->namabarang }}" {{ request('namabarang') == $item->namabarang ? 'selected' : '' }}>{{ $item->namabarang }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="status" id="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Semua Status   </option>
                <option value="Antrian Masuk" {{ request('status') == 'Antrian Masuk' ? 'selected' : '' }}>Antrian Masuk</option>
                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Antrian Keluar" {{ request('status') == 'Antrian Keluar' ? 'selected' : '' }}>Antrian Keluar</option>
                <option value="Dikirim" {{ request('status') == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                <!-- Add other statuses if needed -->
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-grey bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Terapkan Filter
            </button>
        </div>
    </div>
</form>

{{-- Inventory Table --}}
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Gudang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Update</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($viewinventory as $inventory)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->gudang->lokasigudang}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->updated_at}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->produk->namabarang}}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('inventory.updateStatus', $inventory->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option value="Antrian Keluar" {{ $inventory->status == 'Antrian Keluar' ? 'selected' : '' }}>Antrian Keluar</option>
                            <option value="Antrian Masuk" {{ $inventory->status == 'Antrian Masuk' ? 'selected' : '' }}>Antrian Masuk</option>
                            <option value="Dikirim" {{ $inventory->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="Diterima" {{ $inventory->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <!-- Add other statuses if needed -->
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($inventory->qtty, 0, ',', '.') }}</td>
                
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="bg-white px-4 py-3 sm:px-6">
    {{ $viewinventory->appends(request()->input())->links() }}
</div>
