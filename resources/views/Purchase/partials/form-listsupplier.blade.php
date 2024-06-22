
<h3 class="text-lg font-semibold mb-4">Daftar Supplier</h3>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Supplier</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($supplier as $sply)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sply->namasupplier}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sply->alamat}}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $sply->kontak}}</td> 
        </tr>
        @endforeach
    </tbody>
</table>