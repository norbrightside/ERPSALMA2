<!-- resources/views/Gudang/partials/form-addinventory.blade.php -->

<form action="{{ route('produksi.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="Form">
    @csrf

    <div class="mb-4">
        <label for="tanggalproduksi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Produksi</label>
        <input type="date" name="tanggalproduksi" id="tanggalproduksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label for="biayaproduksi" class="block text-gray-700 text-sm font-bold mb-2">Biaya Produksi</label>
        <input type="text" name="biayaproduksi" id="biayaproduksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" data-type="currency" readonly>
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
        function formatCurrency(value) {
            let [integer, fraction] = value.split('.');
            integer = integer.replace(/\D/g, '')
                             .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return fraction ? `${integer}.${fraction}` : integer;
        }

        function unformatCurrency(value) {
            return value.replace(/,/g, '');
        }

        function updateBiayaProduksi() {
            const qttyInput = document.getElementById('qttyproduksi');
            const biayaInput = document.getElementById('biayaproduksi');
            
            // Remove commas for calculation
            const qtty = parseFloat(unformatCurrency(qttyInput.value)) || 0;
            const rate = 352;
            const biaya = qtty * rate;
            biayaInput.value = formatCurrency(biaya.toFixed(0)); // Format result as currency
        }

        // Attach event listeners
        document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
            input.addEventListener('input', function () {
                let value = unformatCurrency(input.value);
                input.value = formatCurrency(value);
                updateBiayaProduksi();
            });
        });

        document.getElementById('Form').addEventListener('submit', function () {
            document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
                input.value = unformatCurrency(input.value);
            });
        });
    });
</script>