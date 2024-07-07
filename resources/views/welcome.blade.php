<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                    @auth
                        Hallo {{ Auth::user()->name }}, selamat bekerja dan semoga harimu menyenangkan.
                    @else
                        Selamat datang di sistem ERP Penggilingan Salma.
                    @endauth
                </h2>
            </div>
        </div>
    </div>
</x-app-layout>
