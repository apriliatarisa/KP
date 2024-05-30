<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1;
            border: none;
            background-color: #d3dcf8; /* Warna biru dari SB Admin */
            color: #ffffff; /* Warna putih untuk teks */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .card * {
            color: #2c40d6; /* Warna putih untuk semua teks di dalam .card */
        }
    </style>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        Update Profile Information
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Delete Account
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
