<!-- resources/views/Gudang/partials/form-addinventory.blade.php -->

<form action="{{ route('produksi.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="produksiForm">
    @csrf

    <div class="mb-4">
        <label for="tanggalproduksi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Produksi</label>
        <input type="date" name="tanggalproduksi" id="tanggalproduksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label for="biayaproduksi" class="block text-gray-700 text-sm font-bold mb-2">Biaya Produksi</label>
        <input type="text" name="biayaproduksi" id="biayaproduksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" data-type="currency" required>
    </div>

    <div class="mb-4">
        <label for="idbarang" class="block text-gray-700 text-sm font-bold mb-2">ID Barang</label>
        <select name="idbarang" id="idbarang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($produk as $barang)
                <option value="{{ $barang->idbarang }}">{{ $barang->namabarang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="qttyproduksi" class="block text-gray-700 text-sm font-bold mb-2">Qtty</label>
        <input type="text" name="qttyproduksi" id="qttyproduksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  data-type="currency" required>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Jadwal Produksi</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
            input.addEventListener('input', function (e) {
                function formatCurrency(value) {
                    return value.replace(/\D/g, '')
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }

                let value = input.value;
                value = formatCurrency(value);
                input.value = value;
            });
        });

        document.getElementById('produksiForm').addEventListener('submit', function (e) {
            document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
                input.value = input.value.replace(/,/g, '');
            });
        });
    });
</script>
