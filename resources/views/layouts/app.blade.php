<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            @php
                $role = strtolower(Auth::user()->role); // Mengubah role menjadi huruf kecil
                $navigationView = 'layouts.' . $role . 'navigation'; // Membentuk nama view yang sesuai
            @endphp

            @if (View::exists($navigationView))
                @include($navigationView)
            @else
                @include('layouts.defaultnavigation')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
