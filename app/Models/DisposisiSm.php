<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiSm extends Model
{
    use HasFactory;

    protected $table = 'disposisi_sm';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_surat_masuk',
        'tujuan',
        'catatan',
    ];

    // Definisi hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Definisi hubungan dengan model SuratMasuk
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat_masuk');
    }

    // // Metode untuk membuat disposisi terkait dengan surat masuk
    // public static function createDisposisi($data)
    // {
    //     return static::create($data);
    // }
}
