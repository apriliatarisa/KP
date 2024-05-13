<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'id_user',
        'tujuan_surat',
        'no_surat',
        'tgl_terbit',
        'isi',
        'file_path',
        'pengirim'
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function disposisi()
    {
        return $this->hasMany(DisposisiSk::class, 'id_surat_keluar');
    }

    // Metode untuk menetapkan pengirim secara otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($suratKeluar) {
            $suratKeluar->pengirim = Auth::user()->name;
        });
    }
}