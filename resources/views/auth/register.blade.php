<x-guest-layout>
    <style>
        body {
            background-color: rgb(206, 187, 80); /* Ganti warna latar belakang halaman menjadi gold */
            height: 100vh; /* Untuk memastikan gambar latar belakang mencakup seluruh tinggi halaman */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8); /* Warna latar belakang transparan untuk kontainer form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Bayangan untuk efek ketinggian */
            max-width: 400px; /* Lebar maksimum kontainer form */
        }

        .form-container h2 {
            color: navy; /* Warna teks untuk judul form */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Tambahkan gaya lainnya sesuai kebutuhan */
    </style>

    <div class="form-container">
    <!-- Logo Perusahaan -->
    <div class="mb-2 flex justify-center"> <!-- Menambahkan mb-2 untuk margin-bottom -->
        <img src="{{ asset('logo/asabri.png') }}" alt="Logo Perusahaan" class="h-17">
    </div>
    <div class="mb-2"><center><p><b>Sistem Informasi Arsip Surat (SIAP) <br>
        ASABRI KC Bengkulu </b></br>
    </p></center></div> <!-- Menambahkan mb-2 untuk margin-bottom -->
    <!-- Tambahkan flex justify-center di sini -->
            <!-- Form Registrasi -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="px-1" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="px-1" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="px-1" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="px-2" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
