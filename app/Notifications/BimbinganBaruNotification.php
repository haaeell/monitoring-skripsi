<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BimbinganBaruNotification extends Notification
{
    use Queueable;

    protected $bimbingan;

    public function __construct($bimbingan)
    {
        $this->bimbingan = $bimbingan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Mahasiswa ' . $this->bimbingan->mahasiswa->nama . ' telah membuat bimbingan baru.',
            'bimbingan_id' => $this->bimbingan->id,
            'mahasiswa_id' => $this->bimbingan->mahasiswa->id
        ];
    }
}

