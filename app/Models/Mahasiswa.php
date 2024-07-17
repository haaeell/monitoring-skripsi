<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{
    use HasFactory,Notifiable;
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
        'pembimbing_id',
        'penguji1_id',
        'penguji2_id',
    ];

    /**
     * Get the user that owns the Mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function judulSkripsi(){
        return $this->hasOne(PengajuanSkripsi::class)
            ->where('status', 'diterima');
    }


    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class,'pembimbing_id');
    }
    public function penguji1()
    {
        return $this->belongsTo(Pembimbing::class,'penguji1_id');
    }
    public function penguji2()
    {
        return $this->belongsTo(Pembimbing::class,'penguji2_id');
    }

    public function bimbinganSkripsi(){
        return $this->hasMany(BimbinganSkripsi::class);
    }
}
