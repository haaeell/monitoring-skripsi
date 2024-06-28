<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'angkatan',
        'jenis_kelamin',
        'email',
        'telp',
        'alamat',
        'judul_ta',
        'pembimbing_id',
    ];

    /**
     * Get the user that owns the Mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class,'pembimbing_id');
    }

    public function bimbinganSkripsi(){
        return $this->hasMany(BimbinganSkripsi::class);
    }
}
