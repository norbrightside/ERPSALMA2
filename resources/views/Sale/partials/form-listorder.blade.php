
    <h3 class="text-lg font-semibold mb-4">Daftar Penjualan</h3>


    <!-- Table to display sales data -->
    
        <table class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Table Header -->
            <thead class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Faktur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Transaksi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtty</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($viewsales as $sales)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sales->nofak }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sales->tanggalpenjualan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sales->pelanggan->namapelanggan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sales->produk->namabarang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->nilaitransaksi, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sales->qttypenjualan, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sales->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('sales.updateStatus', $sales->nofak) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option  >Status</option>
                                <option value="lunas" {{ $sales->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <!-- Tambahkan status lain jika diperlukan -->
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   

    <!-- Pagination Links -->
    <div class="bg-white px-4 py-3 sm:px-6">
        {{ $viewsales->appends(request()->input())->links() }}
    </div>