<form action="{{ route('addsupplier') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf

    <div class="mb-4">
        <label for="namasupplier" class="block text-gray-700 text-sm font-bold mb-2">Nama Supplier</label>
        <input type="text" name="namasupplier" id="namasupplier" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="mb-4">
        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Supplier</label>
        <input type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="mb-4">
        <label for="kontak" class="block text-gray-700 text-sm font-bold mb-2">Kontak Supplier</label>
        <input type="text" name="kontak" id="kontak" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Produk</button>
    </div>
</form>
