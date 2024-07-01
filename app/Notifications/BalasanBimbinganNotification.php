<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class BalasanBimbinganNotification extends Notification
{
    use Queueable;

    protected $bimbinganSkripsi;

    public function __construct($bimbinganSkripsi)
    {
        $this->bimbinganSkripsi = $bimbinganSkripsi;
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan notifikasi ke database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Anda memiliki balasan baru dari pembimbing terkait bimbingan skripsi.',
            'bimbingan_id' => $this->bimbinganSkripsi->id,
            'mahasiswa_id' => $this->bimbinganSkripsi->mahasiswa_id
        ];
    }
}
