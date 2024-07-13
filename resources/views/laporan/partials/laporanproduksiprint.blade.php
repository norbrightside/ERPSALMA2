<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cetak Laporan produksi') }}
        </h2>
        <form action="{{ route('produksi.reportprint') }}" method="GET" class="mb-4">
            <div class="flex space-x-4">
                <div>
            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
            <select name="bulan" id="bulan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">-- Pilih Bulan --</option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ request('bulan') == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700">Pilih Tahun:</label>
            <select name="tahun" id="tahun" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">-- Pilih Tahun --</option>
                @foreach (range(date('Y'), date('Y') - 10) as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black bg-white-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Filter</button>
        </div>
        <button onclick="printInvoice()">Cetak Laporan</button>
        </div>
        </form>
    </x-slot>

    

<div class="py-12 print-area">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="header-container">
                <div class="header-right">
                        <x-application-logo class="logo block h-16 w-auto fill-current text-gray-800" />
                        <h2 class="salma">SALMA</h2>
                </div>
                    <div class="header-left">
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
                        <thead class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                                <<tr>
                                    <td colspan="5" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Biaya Produksi</td>
                                    <td class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ number_format($laporanproduksi->sum('biayaproduksi'), 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                    </table>
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
        </div>
    </div>
    <
    
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
 .idproduksi{
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