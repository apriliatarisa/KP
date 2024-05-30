<x-app-layout>
    <x-slot name="header">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-speedometer"></i> Dashboard</h1>
                <p>Selamat datang, {{ Auth::user()->name }}!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="/admin"><i class="bi bi-house-door fs-6"></i></a></li>
            </ul>
        </div>
    </x-slot>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalSuratMasuk }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-inbox2-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Disposisi Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalDisposisiSuratMasuk }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-journal-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Surat Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalSuratKeluar }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-journal-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               Disposisi Surat Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalDisposisiSuratKeluar }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .welcome-container {
            background: linear-gradient(135deg, #4fc3f7, #81d4fa);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 40px 20px;
            max-width: 500px;
            margin: 0 20px;
        }

        .welcome-message h1 {
            color: #ffffff;
            font-size: 2.5em;
            margin-bottom: 0.5em;
        }

        .welcome-message p {
            color: #ffffff;
            font-size: 1.2em;
            margin-bottom: 1.5em;
        }

        .cta-button {
            background-color: #0288d1;
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            font-size: 1em;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #0277bd;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-message">
            <h1>Selamat Datang!</h1>
            <p>Semangat untuk hari ini. Istirahat dahulu bila lelah dan kembali lagi sesaat kemudian. Bahagia selalu yaa</p>
            <button class="cta-button" onclick="window.location.href='{{ route('surat_masuk.index') }}';">Mulai Bekerja</button>
        </div>
    </div>
</body>
</html>  --}}
