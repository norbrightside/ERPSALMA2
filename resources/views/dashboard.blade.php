<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(auth()->user() && (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sale'))
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Penjualan Hari Ini</h3>
                    <div id="sales-highlight"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "{{ route('sales.highlight') }}",
                method: 'post',
                success: function(data) {
                    var salesContent = '<table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Faktur</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Transaksi</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>' +
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>' +
                        '</tr></thead><tbody class="bg-white divide-y divide-gray-200">';
        
                    var totalPenjualan = 0; // Initialize totalPenjualan variable
        
                    if (data.length === 0) {
                        salesContent += '<tr><td colspan="8" class="px-6 py-3 text-center">Belum ada penjualan hari ini.</td></tr>';
                    } else {
                        $.each(data, function(index, sale) {
                            salesContent += '<tr>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.nofak + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.tanggalpenjualan + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.pelanggan.namapelanggan + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.produk.namabarang + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.nilaitransaksi.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.qttypenjualan + " Kg" + '</td>' +
                                '<td class="px-6 py-4 whitespace-nowrap">' + sale.status + '</td>' +
                                 '</tr>';
                            totalPenjualan += parseFloat(sale.nilaitransaksi); // Calculate total sales
                        });
                    }
        
                    salesContent += '</tbody><tfoot>' +
                        '<tr>' +
                        '<td colspan="6" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</td>' +
                        '<td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                        totalPenjualan.toLocaleString('id-ID', {minimumFractionDigits: 0}) + // Format total sales
                        '</td>' +
                        '</tr>' +
                        '</tfoot></table>';
        
                    $('#sales-highlight').html(salesContent);
                },
                error: function() {
                    $('#sales-highlight').html('Failed to load sales data.');
                }
            });
        });
    </script>
@endif


@if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Produksi')
<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Produksi Hari Ini</h3>
                <div id="jadwal-produksi-highlight"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('produksi.jadwal') }}",
            method: 'post',
            success: function(data) {
                var jadwalContent = '<table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Produksi</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>' +
                    '</tr></thead><tbody class="bg-white divide-y divide-gray-200">';
        
                if (data.length === 0) {
                    jadwalContent += '<tr><td colspan="3" class="px-6 py-3 text-center">Tidak ada jadwal produksi hari ini.</td></tr>';
                } else {
                    $.each(data.data, function(index, item) {
                        jadwalContent += '<tr>' +
                            '<td class="px-6 py-4">' + item.produk.namabarang + '</td>' +
                            '<td class="px-6 py-4">' + item.tanggalproduksi + '</td>' + // Adjust based on your field names
                            '<td class="px-6 py-4">' + item.status + '</td>' +
                            '</tr>';
                    });
                }
        
                jadwalContent += '</tbody></table>';
                $('#jadwal-produksi-highlight').html(jadwalContent);
            },
            error: function() {
                $('#jadwal-produksi-highlight').html('Gagal memuat data jadwal produksi.');
            }
        });
    });
</script>
@endif

@if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Purchase')
<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Highlight Pembelian</h3>
                <div id="pembelian-highlight"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('pembelian.highlight.today') }}",
            method: 'post',
            success: function(data) {
                var pembelianContent = '<table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Order</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pembelian</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Supplier</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>' +
                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>' +
                    '</tr></thead><tbody class="bg-white divide-y divide-gray-200">';
        
                if (data.length === 0) {
                    pembelianContent += '<tr><td colspan="5" class="px-6 py-3 text-center">Tidak ada pembelian terbaru.</td></tr>';
                } else {
                    $.each(data.data, function(index, item) {
                        pembelianContent += '<tr>' +
                            '<td class="px-6 py-4">' + item.idorder + '</td>' +  // Nomor Order
                            '<td class="px-6 py-4">' + item.tanggalorder + '</td>' + // Tanggal Pembelian
                            '<td class="px-6 py-4">' + item.supplier.namasupplier + '</td>' + // Nama Supplier
                            '<td class="px-6 py-4">' + item.produk.namabarang + '</td>' + // Nama Produk
                            '<td class="px-6 py-4">' + item.status + '</td>' + // Status
                            '</tr>';
                    });
                }
        
                pembelianContent += '</tbody></table>';
                $('#pembelian-highlight').html(pembelianContent);
            },
            error: function() {
                $('#pembelian-highlight').html('Gagal memuat data pembelian.');
            }
        });
    });
</script>
@endif

@if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Gudang')
<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Highlight Stok Tersisa</h3>
                    <div id="stock-highlight"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: "{{ route('stock.highlight') }}",
                        method: 'post',
                        success: function(data) {
                            var stockContent = '<table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr>' +
                                '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Gudang</th>' +
                                '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>' +
                                '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa Stok</th>' +
                                '</tr></thead><tbody class="bg-white divide-y divide-gray-200">';
            
                            if (data.length === 0) {
                                stockContent += '<tr><td colspan="3" class="px-6 py-3 text-center">Tidak ada stok tersisa.</td></tr>';
                            } else {
                                $.each(data, function(index, item) {
                                    stockContent += '<tr>' +
                                        '<td class="px-6 py-4">' + item.lokasigudang + '</td>' +
                                        '<td class="px-6 py-4">' + item.namabarang + '</td>' +
                                        '<td class="px-6 py-4">' + Math.floor(item.total_qtty) + " Kg" +'</td>' +
                                        '</tr>';
                                });
                            }
            
                            stockContent += '</tbody></table>';
                            $('#stock-highlight').html(stockContent);
                        },
                        error: function() {
                            $('#stock-highlight').html('Failed to load stock data.');
                        }
                    });
                });
            </script>
         
    </div>
</div>
@endif


</x-app-layout>
