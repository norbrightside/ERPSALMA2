<form action="{{ route('produk.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf

    <div class="mb-4">
        <label for="namabarang" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
        <input type="text" name="namabarang" id="namabarang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Produk</button>
    </div>
</form>
