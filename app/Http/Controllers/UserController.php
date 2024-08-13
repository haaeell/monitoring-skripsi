<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $angkatanFilter = $request->input('angkatan');

        if ($angkatanFilter) {
            $mahasiswas = Mahasiswa::with('pembimbing')
                ->where('angkatan', $angkatanFilter)
                ->get();
        } else {
            $mahasiswas = Mahasiswa::with('pembimbing')->get();
        }

        foreach ($mahasiswas as $mahasiswa) {
            $mahasiswa->status_sidang = $this->getStatusSidang($mahasiswa->id);
        }

        $pembimbings = Pembimbing::all();
        $totalMahasiswa = $mahasiswas->count();
        $totalPembimbing = $pembimbings->count();
        $angkatanOptions = Mahasiswa::distinct()->pluck('angkatan');

        return view('lno.data.index', compact('mahasiswas', 'totalMahasiswa', 'pembimbings', 'totalPembimbing', 'angkatanOptions'));
    }

    private function getStatusSidang($mahasiswaId)
    {
        $jadwalUjian = JadwalUjian::where('mahasiswa_id', $mahasiswaId)->get();

        $status = [
            'proposal' => false,
            'pendadaran' => false,
        ];

        foreach ($jadwalUjian as $ujian) {
            if ($ujian->kategori === 'Proposal' && $ujian->status === 'diterima') {
                $status['proposal'] = true;
            }
            if ($ujian->kategori === 'Pendadaran' && $ujian->status === 'diterima') {
                $status['pendadaran'] = true;
            }
        }

        return $status;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
