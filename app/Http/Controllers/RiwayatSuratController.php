<?php

namespace App\Http\Controllers;

use App\Models\RiwayatSurat;
use Illuminate\Support\Facades\DB;

class RiwayatSuratController extends Controller
{
    public function index()
    {
        // Query untuk mendapatkan data surat masuk dan surat keluar beserta informasi petugas
        $riwayatSurat = DB::table('surat_masuk')
    ->select(
        'surat_masuk.no_surat as no_surat',
        DB::raw("'surat_masuk' as jenis_surat"),
        'users.name as petugas',
        DB::raw('YEAR(surat_masuk.created_at) as tahun'), // Menggunakan YEAR() untuk mendapatkan tahun dari created_at
        'surat_masuk.created_at as timestamps'
    )
    ->join('users', 'surat_masuk.id_user', '=', 'users.id')
    ->whereNotNull('surat_masuk.id_user')
    ->whereNotNull('surat_masuk.tgl_terima')
    ->union(
        DB::table('surat_keluar')
            ->select(
                'surat_keluar.no_surat as no_surat',
                DB::raw("'surat_keluar' as jenis_surat"),
                'users.name as petugas',
                DB::raw('YEAR(surat_keluar.created_at) as tahun'), // Menggunakan YEAR() untuk mendapatkan tahun dari created_at
                'surat_keluar.created_at as timestamps'
            )
            ->join('users', 'surat_keluar.id_user', '=', 'users.id')
            ->whereNotNull('surat_keluar.id_user')
            ->whereNotNull('surat_keluar.tgl_terbit')
    )
    ->orderBy('timestamps', 'desc')
    ->paginate(10);


        return view('riwayat-surat.riwayat_surat', compact('riwayatSurat'));
    }

    // Define other methods such as storeSuratMasuk and storeSuratKeluar here
}
