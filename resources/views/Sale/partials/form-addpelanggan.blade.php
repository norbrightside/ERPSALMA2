<form action="{{ route('pelanggan.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf


    <div class="mb-4">
        <label for="namapelanggan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelanggan</label>
        <input type="text" name="namapelanggan" id="namapelanggan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @if ($errors->has('namapelanggan'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('namapelanggan') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @if ($errors->has('alamat'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('alamat') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="kontak" class="block text-gray-700 text-sm font-bold mb-2">Kontak</label>
        <input type="text" name="kontak" id="kontak" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @if ($errors->has('kontak'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('kontak') }}</p>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Pelanggan</button>
    </div>
</form>
