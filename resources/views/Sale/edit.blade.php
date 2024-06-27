<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Order') }}
        </h2>
    </x-slot>

    <form action="{{ route('sales.update', $sale->nofak) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status">
            <option value="Order Baru" {{ $sale->status == 'Order Baru' ? 'selected' : '' }}>Order Baru</option>
            <option value="Lunas" {{ $sale->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            <option value="Pengiriman" {{ $sale->status == 'Pengiriman' ? 'selected' : '' }}>Pengiriman</option>
            <option value="Selesai" {{ $sale->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button type="submit">Simpan</button>
    </form>
    
</x-app-layout>
