<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use App\Models\PengajuanSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudulSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $angkatanFilter = $request->input('angkatan');
    
        // Inisialisasi query berdasarkan peran pengguna
        $riwayatPengajuanSkripsiQuery = PengajuanSkripsi::query();
    
        if (Auth::user()->role == 'mahasiswa') {
            $riwayatPengajuanSkripsiQuery->where('mahasiswa_id', Auth::user()->mahasiswa->id);
        }
    
        if ($angkatanFilter) {
            // Filter berdasarkan angkatan jika ada
            $riwayatPengajuanSkripsiQuery->whereHas('mahasiswa', function ($query) use ($angkatanFilter) {
                $query->where('angkatan', $angkatanFilter);
            });
        }
    
        if (Auth::user()->role == "pembimbing") {
            // Pembimbing hanya melihat status 'diterima'
            $riwayatPengajuanSkripsiQuery->where('status', 'diterima');
        }
    
        // Ambil data sesuai filter yang diterapkan
        $riwayatPengajuanSkripsi = $riwayatPengajuanSkripsiQuery->get();
    
        // Ambil opsi angkatan untuk filter
        $angkatanOptions = Mahasiswa::distinct()->pluck('angkatan')->sort()->toArray();
        $dpsList = Pembimbing::all();
    
        return view('judul_skripsi.index', compact('riwayatPengajuanSkripsi', 'angkatanOptions','dpsList'));
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
