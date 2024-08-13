<?php

namespace App\Http\Controllers;

use App\Models\BimbinganSkripsi;
use App\Models\JadwalUjian;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use App\Models\PengajuanSkripsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahDosen = Pembimbing::count();
        $jumlahMahasiswa = Mahasiswa::count();

        $jumlahMahasiswaPerAngkatan = Mahasiswa::select('angkatan', DB::raw('count(*) as total'))
            ->groupBy('angkatan')
            ->get();

        $jumlahMahasiswaSeminarPerAngkatan = Mahasiswa::select('angkatan')
            ->join('jadwal_ujian', 'mahasiswa.id', '=', 'jadwal_ujian.mahasiswa_id')
            ->select('mahasiswa.angkatan', DB::raw('count(distinct jadwal_ujian.mahasiswa_id) as total'))
            ->whereIn('jadwal_ujian.kategori', ['Proposal', 'Pendadaran'])
            ->groupBy('mahasiswa.angkatan')
            ->get();

        if ($user->role == 'mahasiswa') {
            $bimbingan = BimbinganSkripsi::where('mahasiswa_id', $user->mahasiswa->id)->get();
            $jumlahBimbingan = BimbinganSkripsi::where('mahasiswa_id', $user->mahasiswa->id)->count();
            $statusBimbingan = BimbinganSkripsi::where('id', $user->mahasiswa->id)->first()->status ?? null;
            $terakhirBimbingan = BimbinganSkripsi::where('mahasiswa_id', $user->mahasiswa->id)->latest()->first();
            $judulDiterima = PengajuanSkripsi::where('mahasiswa_id', $user->mahasiswa->id)->where('status', 'diterima')->first();
            $jadwalUjian = JadwalUjian::where('mahasiswa_id', $user->mahasiswa->id)->get();
            return view('home', compact('jumlahBimbingan', 'bimbingan', 'statusBimbingan', 'terakhirBimbingan', 'judulDiterima', 'jadwalUjian'));
        }

        if (Auth::user()->role == 'pembimbing') {
            $pembimbing = $user->pembimbing;
            $pembimbingId = $pembimbing ? $pembimbing->id : null;
            $mahasiswaIds = $pembimbing ? $pembimbing->mahasiswa()->pluck('id') : [];
            $jadwalMenguji = JadwalUjian::where(function ($query) use ($pembimbingId, $mahasiswaIds) {
                $query->where('penguji1_id', $pembimbingId)
                    ->orWhere('penguji2_id', $pembimbingId)
                    ->orWhereIn('mahasiswa_id', $mahasiswaIds);
            })->where('tanggal', '>', Carbon::today())
                ->where('status', 'diterima')
                ->get();

            
            $jumlahMahasiswaBimbingan = Mahasiswa::where('pembimbing_id', $pembimbingId)->count();
            $jumlahSidangProposal = JadwalUjian::where('kategori', 'Proposal')
                ->where(function ($query) use ($pembimbingId) {
                    $query->where('penguji1_id', $pembimbingId)
                        ->orWhere('penguji2_id', $pembimbingId);
                })->count();

            $jumlahSidangPendadaran = JadwalUjian::where('kategori', 'Pendadaran')
                ->where(function ($query) use ($pembimbingId) {
                    $query->where('penguji1_id', $pembimbingId)
                        ->orWhere('penguji2_id', $pembimbingId);
                })->count();

            return view('home', compact('jadwalMenguji', 'jumlahMahasiswaBimbingan', 'jumlahSidangProposal', 'jumlahSidangPendadaran'));
        }
        return view('home', compact('jumlahDosen', 'jumlahMahasiswa', 'jumlahMahasiswaPerAngkatan','jumlahMahasiswaSeminarPerAngkatan'));
    }
}
