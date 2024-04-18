<!-- disposisi.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Disposisi Surat</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <!-- Tambahkan kolom lain jika diperlukan -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- Tambahkan sel lain sesuai dengan kebutuhan -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
