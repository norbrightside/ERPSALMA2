<form action="{{ route('penjualan.store') }}" method="POST" class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="Form">
    @csrf

    
    <div class="mb-4">
        <label for="tanggalpenjualan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Penjualan</label>
        <input type="date" name="tanggalpenjualan" id="tanggalpenjualan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        @if ($errors->has('tanggalpenjualan'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('tanggalpenjualan') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="idpelanggan" class="block text-gray-700 text-sm font-bold mb-2">Pelanggan</label>
        <select name="idpelanggan" id="idpelanggan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach ($pelanggan as $cust)
                <option value="{{ $cust->idpelanggan }}">{{ $cust->namapelanggan }}</option>
            @endforeach
        </select>
        @if ($errors->has('idpelanggan'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('idpelanggan') }}</p>
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
        <label for="nilaitransaksi" class="block text-gray-700 text-sm font-bold mb-2">Nilai Transaksi</label>
        <input type="text" name="nilaitransaksi" id="nilaitransaksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  data-type="currency" required>
        @if ($errors->has('nilaitransaksi'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('nilaitransaksi') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="qttypenjualan" class="block text-gray-700 text-sm font-bold mb-2">Qty Penjualan</label>
        <input type="text" name="qttypenjualan" id="qttypenjualan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  data-type="currency" required>
        @if ($errors->has('qttypenjualan'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('qttypenjualan') }}</p>
        @endif
    </div>


    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Penjualan</button>
    </div>
</form>