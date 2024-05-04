<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiSk extends Model
{
    use HasFactory;

    protected $table = 'disposisi_sk';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_surat_keluar',
        'tujuan',
        'catatan',
        'status',
    ];

    // Definisi hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'tujuan');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Definisi hubungan dengan model SuratKeluar
    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'id_surat_keluar');
    }
}
