<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSkripsi extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_skripsi';
    protected $fillable = ['mahasiswa_id', 'judul_skripsi','abstrak', 'status', 'catatan_ditolak'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
