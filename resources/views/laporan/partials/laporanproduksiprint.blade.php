<x-app-layout>
    <div class="py-12 print-area">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="header-container">
                        <div class="header-right">
                            <img src="{{ asset('build/assets/logo.png') }}" alt="Logo" class="w-40 h-40" />                        
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
                                <h2 class="idproduksi">Laporan Produksi Bulan {{ $months[$queryString['bulan']] }} {{ $queryString['tahun'] }}</h2>
                            @elseif(isset($queryString['bulan']))
                                <h2 class="idproduksi">Laporan Produksi Bulan {{ $months[$queryString['bulan']] }}</h2>
                            @elseif(isset($queryString['tahun']))
                                <h2 class="idproduksi">Laporan Produksi Tahun {{ $queryString['tahun'] }}</h2>
                            @else
                                <h2 class="idproduksi">Laporan Total Produksi</h2>
                            @endif
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Produksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($laporanproduksi as $produksi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produksi->idproduksi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produksi->tanggalproduksi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produksi->produk->namabarang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produksi->biayaproduksi, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produksi->qttyproduksi, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produksi->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Biaya Produksi</td>
                                <td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ number_format($laporanproduksi->sum('biayaproduksi'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
    
        .idproduksi {
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
