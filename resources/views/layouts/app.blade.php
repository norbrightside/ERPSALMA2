<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ERP SALMA') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        
    </head>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
                input.addEventListener('input', function (e) {
                    function formatCurrency(value) {
                        return value.replace(/\D/g, '')
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
    
                    let value = input.value;
                    value = formatCurrency(value);
                    input.value = value;
                });
            });
    
            document.getElementById('Form').addEventListener('submit', function (e) {
                document.querySelectorAll('input[data-type="currency"]').forEach(function (input) {
                    input.value = input.value.replace(/,/g, '');
                });
            });
        });
    </script>
    
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @guest
    @include('layouts.defaultnavigation') <!-- Tampilkan navigasi default jika pengguna tidak login -->
@else
    @php
        $role = strtolower(Auth::user()->role); // Mengambil role pengguna jika sudah login
        $navigationView = 'layouts.' . $role . 'navigation'; // Membentuk nama view navigasi sesuai role
    @endphp

    @if (View::exists($navigationView))
        @include($navigationView) <!-- Tampilkan navigasi sesuai role jika view tersedia -->
    @else
        @include('layouts.defaultnavigation') <!-- Tampilkan navigasi default jika view sesuai role tidak tersedia -->
    @endif
@endguest

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
