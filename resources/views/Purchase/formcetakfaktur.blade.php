    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cetak Faktur') }}
            </h2>
        </x-slot>
        <div class="py-12 print-area">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="header-container">
                        <div class="header-right">
                            <x-application-logo class="logo block h-9 w-auto fill-current text-gray-800" />
                            <h2 class="salma">SALMA</h2>
                            <p class="alamat" >Gudang {{ $pembelian->gudang->lokasigudang }}</p>
                        </div>
                        <div class="header-left">
                        <h2 class="idorder">Faktur Pembelian #{{ $pembelian->idorder }}</h2>
                        <p class="alamat">{{ $pembelian->tanggalorder }}
                            <br>
                            {{ $pembelian->supplier->namasupplier }} <br>
                            {{ $pembelian->supplier->kontak }} <br>
                            {{ $pembelian->supplier->alamat }}
                            </p>
                        
                        </div>
                        </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $pembelian->produk->namabarang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->qttyorder) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->harga )}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->qttyorder*$pembelian->harga) }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Upah Buruh</td>
                    <td class="px-6 py-4 whitespace-nowrap">-</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->kongsi)}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->kongsi)}}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Upah Tampih</td>
                    <td class="px-6 py-4 whitespace-nowrap">-</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->angin)}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->angin)}}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Ongkos Trasport</td>
                    <td class="px-6 py-4 whitespace-nowrap">-</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->mobil)}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($pembelian->mobil)}}</td>
                </tr>
                </tbody>
                <tfoot>
                    <td colspan="3" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pembelian</td>
                        <td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ number_format($pembelian->total )}}</td>
                        <td colspan="3"></td>    
                </tfoot>
                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
            </table>
            <div class="btn-print">
                <button onclick="printInvoice()">Cetak Faktur</button>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            function printInvoice() {
                window.print();
            }
        </script>
    </div>
    </div>
    </div>
    </div>

    <style>
           .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .header-left {
            display: flex;
            flex-direction: column;
        }

        .header-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .logo {
            margin-left: 0px;
            margin-bottom: 5px;
        }

        .salma {
            font-size: 24px;
            font-weight: bold;
        }
        .alamat
        {
            font-size: 12px;
            font-weight: bold;
        }
        .idorder{
            font-size: 24px;
            font-weight: bold;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    </x-app-layout>
