<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tampilkan daftar user -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Daftar User</h3>
                <div class="overflow-hidden border border-gray-200 rounded-lg">
                    <form id="delete-form" method="POST" action="{{ route('user.delete') }}">
                        @csrf
                        @method('DELETE')
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Checkbox for user deletion -->
                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="rounded-md">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center justify-end mt-4">
                            <!-- Button to delete selected users -->
                            <x-danger-button onclick="event.preventDefault(); deleteUsers()">
                                {{ __('Delete Selected') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form Registrasi User -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Role Selection -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('role')" />

                            <select id="role" name="role" class="block mt-1 w-full" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin">Admin</option>
                                <option value="Sale">Sale</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Gudang">Gudang</option>
                                <option value="Purchase">Purchase</option>
                            </select>

                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteUsers() {
            if (confirm('Are you sure you want to delete the selected users?')) {
                document.getElementById('delete-form').submit();
            }
        }

        // Handle refresh after delete
        @if(session('success'))
            window.onload = function() {
                alert("{{ session('success') }}");
                location.reload();
            }
        @endif
    </script>
</x-app-layout>
