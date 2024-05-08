<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'unread_disposisi_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with SuratKeluar
    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    // Mutator untuk menambah jumlah disposisi yang belum dibaca
    public function incrementUnreadDisposisiCount()
    {
        $this->unread_disposisi_count++;
        $this->save();
    }

    // Mutator untuk mengurangi jumlah disposisi yang belum dibaca
    public function decrementUnreadDisposisiCount()
    {
        if ($this->unread_disposisi_count > 0) {
            $this->unread_disposisi_count--;
            $this->save();
        }
    }

    public function incrementUnreadDisposisiskCount()
    {
        $this->unread_disposisisk_count++;
        $this->save();
    }

    public function decrementUnreadDisposisiskCount()
    {
        $this->unread_disposisisk_count--;
        $this->save();
    }
}
