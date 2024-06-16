<!-- resources/views/produksi/partials/form-addjadwal.blade.php -->

<form action="{{ route('jadwal-produksi.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="tanggalproduksi" class="form-label">Tanggal Produksi</label>
        <input type="date" class="form-control" id="tanggalproduksi" name="tanggalproduksi" required>
    </div>

    <div class="mb-3">
        <label for="biayaproduksi" class="form-label">Biaya Produksi</label>
        <input type="number" class="form-control" id="biayaproduksi" name="biayaproduksi" required>
    </div>

    <div class="mb-3">
        <label for="idbarang" class="form-label">Nama Barang</label>
        <select class="form-control" id="idbarang" name="idbarang" required>
            @foreach ($barang as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="qttyproduksi" class="form-label">Qty Produksi</label>
        <input type="number" class="form-control" id="qttyproduksi" name="qttyproduksi" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Pending">Pending</option>
            <option value="Selesai">Selesai</option>
            <option value="Batal">Batal</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
