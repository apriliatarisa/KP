<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_surat_masuk',
        'id_surat_keluar',
        'no_agenda_sm',
        'surat_masuk',
        'no_agenda_sk',
        'surat_keluar',
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat_masuk');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'id_surat_keluar');
    }
}
