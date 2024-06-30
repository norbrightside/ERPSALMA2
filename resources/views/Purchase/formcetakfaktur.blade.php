<!-- resources/views/Purchase/formcetakfaktur.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Faktur Pembelian</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content p {
            margin: 5px 0;
        }
        .print-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Faktur Pembelian</h1>
        </div>
        <div class="content">
            <p px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider>Tanggal Order: {{ $pembelian->tanggalorder }}</p>
            <p>Supplier: {{ $pembelian->supplier->namasupplier }}</p>
            <p>Barang: {{ $pembelian->produk->namabarang }}</p>
            <p>Gudang: {{ $pembelian->gudang->lokasigudang }}</p>
            <p>Quantity Order: {{ $pembelian->qttyorder }}</p>
            <p>Harga Pembelian: {{ $pembelian->hargapembelian }}</p>
            <p>Total Bayar: {{ $pembelian->totalbayar }}</p>
            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
        </div>
        <div class="print-button">
            <button onclick="window.print(); setTimeout(() => { window.location.href = '{{ route('viewpurchaselist') }}'; }, 1000);">Cetak Faktur</button>
        </div>
    </div>
</body>
</html>
