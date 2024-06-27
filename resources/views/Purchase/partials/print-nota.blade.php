<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <style>
        /* Tambahkan CSS styling sesuai kebutuhan */
    </style>
</head>
<body>
    <h2 class="text-lg font-bold mb-2">Nota Pembelian</h2>
    <p><strong>Tanggal Order:</strong> {{ $pembelian->tanggalorder }}</p>
    <p><strong>Supplier:</strong> {{ $pembelian->supplier->namasupplier }}</p>
    <p><strong>Gudang Tujuan:</strong> {{ $pembelian->gudang->lokasigudang }}</p>
    <p><strong>Produk:</strong> {{ $pembelian->produk->namabarang }}</p>
    <p><strong>Qtty Order:</strong> {{ $pembelian->qttyorder }}</p>
    <p><strong>Harga Pembelian:</strong> {{ $pembelian->hargapembelian }}</p>
    <p><strong>Total Bayar:</strong> {{ $pembelian->totalbayar }}</p>
</body>
</html>
