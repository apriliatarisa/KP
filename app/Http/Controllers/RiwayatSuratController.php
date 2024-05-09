<?php
namespace App\Http\Controllers;

use App\Models\RiwayatSurat;

class RiwayatSuratController extends Controller
{
    public function index()
    {
        $riwayatSurat = RiwayatSurat::orderBy('created_at', 'desc')->paginate(10);


        return view('riwayat-surat.riwayat_surat', compact('riwayatSurat'));
    }

    // Define other methods such as storeSuratMasuk and storeSuratKeluar here
}