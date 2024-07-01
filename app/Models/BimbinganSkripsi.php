<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BimbinganSkripsi extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'bimbingan_skripsi';

    protected $fillable = [
        'mahasiswa_id', 'pembahasan_mhs', 'pembahasan_dosen', 'file', 'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
