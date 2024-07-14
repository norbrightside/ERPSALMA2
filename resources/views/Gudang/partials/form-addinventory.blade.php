<form action="{{ route('inventory.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf

    <div class="mb-4">
        <label for="idgudang" class="block text-gray-700 text-sm font-bold mb-2">lokasigudang</label>
        <select name="idgudang" id="idgudang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($gudang as $lokasi)
                <option value="{{ $lokasi->idgudang }}">{{ $lokasi->lokasigudang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label for="idbarang" class="block text-gray-700 text-sm font-bold mb-2">Barang</label>
        <select name="idbarang" id="idbarang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($produk as $barang)
                <option value="{{ $barang->idbarang }}">{{ $barang->namabarang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="qtty" class="block text-gray-700 text-sm font-bold mb-2">Qty</label>
        <input type="number" name="qtty" id="qtty" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" step="any" required>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Inventory</button>
    </div>
</form>
