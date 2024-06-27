<form action="{{ route('pembelian.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="Form">
    @csrf

    
    <div class="mb-4">
        <label for="tanggalorder" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Order</label>
        <input type="date" name="tanggalorder" id="tanggalorder" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @if ($errors->has('tanggalorder'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('tanggalorder') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="idsupplier" class="block text-gray-700 text-sm font-bold mb-2">Suplier</label>
        <select name="idsupplier" id="idsupplier" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($supplier as $suplr)
                <option value="{{ $suplr->idsupplier }}">{{ $suplr->namasupplier }}</option>
            @endforeach
        </select>
        @if ($errors->has('idsupplier'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('idsupplier') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="idgudang" class="block text-gray-700 text-sm font-bold mb-2">Gudang Tujuan</label>
        <select name="idgudang" id="idgudang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($gudang as $gdg)
                <option value="{{ $gdg->idgudang }}">{{ $gdg->lokasigudang }}</option>
            @endforeach
        </select>
        @if ($errors->has('idsupplier'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('idsupplier') }}</p>
        @endif
    </div>
    <div class="mb-4">
        <label for="idbarang" class="block text-gray-700 text-sm font-bold mb-2">Produk</label>
        <select name="idbarang" id="idbarang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($produk as $item)
                <option value="{{ $item->idbarang }}">{{ $item->namabarang }}</option>
            @endforeach
        </select>
        @if ($errors->has('idbarang'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('idbarang') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="qttyorder" class="block text-gray-700 text-sm font-bold mb-2">Qtty Order</label>
        <input type="text" name="qttyorder" id="qttyorder" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  data-type="currency" required>
        @if ($errors->has('qttyorder'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('qttyorder') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="hargapembelian" class="block text-gray-700 text-sm font-bold mb-2">Harga Pembelian</label>
        <input type="text" name="hargapembelian" id="hargapembelian" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  data-type="currency" required>
        @if ($errors->has('hargapembelian'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('hargapembelian') }}</p>
        @endif
    </div>
    <div class="mb-4">
        <label for="totalbayar" class="block text-gray-700 text-sm font-bold mb-2">Total Bayar</label>
        <input type="text" name="totalbayar" id="totalbayar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Pembelian</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#qttyorder, #hargapembelian').on('input', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var qtty = parseFloat($('#qttyorder').val().replace(/,/g, '') || 0); // Menggunakan 0 jika kosong
            var harga = parseFloat($('#hargapembelian').val().replace(/,/g, '') || 0); // Menggunakan 0 jika kosong
            var total = qtty * harga;
            $('#totalbayar').val(formatCurrency(total)); // Tampilkan dengan format currency
        }

        function formatCurrency(value) {
            return value.toLocaleString('id-ID'); // Format ke mata uang Indonesia
        }

        $('#Form').submit(function(e) {
            $('#qttyorder, #hargapembelian').each(function() {
                var value = $(this).val().replace(/,/g, ''); // Hapus koma sebelum submit
                $(this).val(value);
            });
        });
    });
</script>
