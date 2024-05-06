<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

     // Mutator untuk menambah jumlah disposisi surat keluar yang belum dibaca
     public function incrementUnreadDisposisiskCount()
     {
         $this->unread_disposisisk_count++;
         $this->save();
     }
 
     // Mutator untuk mengurangi jumlah disposisi surat keluar yang belum dibaca
     public function decrementUnreadDisposisiskCount()
     {
         if ($this->unread_disposisisk_count > 0) {
             $this->unread_disposisisk_count--;
             $this->save();
         }
     }
}
