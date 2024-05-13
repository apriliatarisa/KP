<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'asal_surat',
        'no_surat',
        'tgl_terima',
        'isi',
        'file_path',
        'penerima',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan model DisposisiSm
    public function disposisi()
    {
        return $this->hasMany(DisposisiSm::class, 'id_surat_masuk');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($suratKeluar) {
            $suratKeluar->penerima = Auth::user()->name;
        });
    }
    

}
