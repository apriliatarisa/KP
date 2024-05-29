<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        body {
            background-color: navy; /* Ganti warna latar belakang halaman menjadi navy */
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
            color: white; /* Warna teks untuk judul form */
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
        <div class="mb-2"><center><p><b>Sistem Informasi Arsip (SIAP) Surat <br>
            ASABRI KC Bengkulu </b></br>
        </p></center></div> <!-- Menambahkan mb-2 untuk margin-bottom -->
        <!-- Tambahkan flex justify-center di sini -->
        <div class="flex justify-center">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="px-1" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="width: 380px;" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="px-1" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" style="width: 380px;" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mb-4"> <!-- Tambahkan mb-4 di sini -->
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3 bg-navy hover:bg-blue-800">
                        {{ __('Log in') }}
                    </x-primary-button>
                    {{-- <a href="/register">
                        <x-primary-button type="button" class="ml-3 bg-navy hover:bg-blue-800">
                            {{ __('Register') }}
                        </x-primary-button>
                    </a> --}}
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
