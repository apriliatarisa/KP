<?php

namespace App\Notifications;

use App\Models\DisposisiSm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DisposisiBaruNotification extends Notification
{
    use Queueable;

    protected $disposisi;

    public function __construct(DisposisiSm $disposisi)
    {
        $this->disposisi = $disposisi;
    }

    public function via($notifiable)
    {
        return ['mail']; // Anda bisa menyesuaikan dengan channel lain seperti database, broadcast, dll.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Anda menerima disposisi baru')
            ->line('Anda telah menerima disposisi baru dari ' . $this->disposisi->pengirim->name)
            ->line('Surat Masuk: ' . $this->disposisi->suratMasuk->no_surat)
            ->action('Lihat Disposisi', route('disposisi_sm.show', $this->disposisi->id))
            ->line('Terima kasih!');
    }
}
