<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\DisposisiSm;
use App\Models\DisposisiSk;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total surat masuk, keluar, dan disposisi
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalDisposisiSuratMasuk = DisposisiSm::count();
        $totalDisposisiSuratKeluar = DisposisiSk::count();
        // dd($totalSuratMasuk);
        // Mengirim data ke view
        return view('dashboard', compact('totalSuratMasuk', 'totalSuratKeluar', 'totalDisposisiSuratMasuk', 'totalDisposisiSuratKeluar'));
    }
}
