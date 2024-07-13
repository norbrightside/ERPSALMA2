<x-app-layout>
    
        
                

    <div class="py-12 print-area">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="header-container">
                        <div class="header-right">
                            <x-application-logo class="logo block h-25 w-auto fill-current text-gray-800" />
                            <h2 class="salma">SALMA</h2>
                        </div>
                        <div class="header-left">
                            <button class="btn-print" onclick="printInvoice()">Print</button>
                            @php
                                $months = [
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                ];
                            @endphp
                        
                            @if(isset($queryString['bulan']) && isset($queryString['tahun']))
                                <h2 class="idorder">Laporan Penjualan Bulan {{ $months[$queryString['bulan']] }} {{ $queryString['tahun'] }}</h2>
                            @elseif(isset($queryString['bulan']))
                                <h2 class="idorder">Laporan Penjualan Bulan {{ $months[$queryString['bulan']] }}</h2>
                            @elseif(isset($queryString['tahun']))
                                <h2 class="idorder">Laporan Penjualan Tahun {{ $queryString['tahun'] }}</h2>
                            @else
                                <h2 class="idorder">Laporan Total Penjualan</h2>
                            @endif
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Faktur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($laporan as $sales)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->nofak }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->tanggalpenjualan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->pelanggan->namapelanggan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->produk->namabarang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->qttypenjualan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->nilaitransaksi, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sales->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</td>
                                <td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ number_format($laporan->sum('nilaitransaksi'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
    function printInvoice() {
        window.print();
    }
    </script>
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
    
        .alamat {
            font-size: 12px;
            font-weight: bold;
        }
    
        .idorder {
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
    