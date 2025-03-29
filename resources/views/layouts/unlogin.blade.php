<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ERP SALMA') }}</title>
    <link rel="icon" href="{{ asset('build/assets/favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen  flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <header class="header w-full bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6 md:justify-start">
                    <div class=" justify-start lg:w-0 lg:flex-1">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                    </div>
                    
                    <nav class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" >
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" >
                                    Log in
                                </a>
                            @endauth
                        @endif
                        <!-- Tambahkan link lain di sini jika diperlukan -->
                    </nav>
                </div>
            </div>
        </header>
  <!-- Page Content -->
  <main>
    {{ $slot }}
</main>
</div>
</body>
</html>
