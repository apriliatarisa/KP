<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSurat extends Model
{
    protected $table = 'riwayat_surat';

    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'petugas',
        'id_surat_masuk',
        'id_surat_keluar',
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat_masuk');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'id_surat_keluar');
    }
    public function getYearAttribute()
    {
        // Periksa apakah ada surat masuk terkait
        if ($this->suratMasuk) {
            return $this->suratMasuk->tgl_input->format('Y');
        }
        // Periksa apakah ada surat keluar terkait
        elseif ($this->suratKeluar) {
            return $this->suratKeluar->tgl_input->format('Y');
        }
        // Jika tidak ada surat masuk atau surat keluar terkait, kembalikan null
        else {
            return null;
        }
    }
}
