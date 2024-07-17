<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ujian';
    protected $fillable = [
        'mahasiswa_id', 'judul', 'kategori', 'tanggal', 'waktu', 'ruangan', 'penguji1_id','ec','plagiarsm', 'penguji2_id', 'status', 'catatan_ditolak'
    ];

    public function penguji1()
    {
        return $this->belongsTo(Pembimbing::class, 'penguji1_id');
    }

    public function penguji2()
    {
        return $this->belongsTo(Pembimbing::class, 'penguji2_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen(){
        return $this->belongsTo(Pembimbing::class);
    }
}
