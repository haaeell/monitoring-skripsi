<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BimbinganSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $mahasiswaId = Auth::user()->mahasiswa->id;
        $bimbingan = BimbinganSkripsi::where('mahasiswa_id', $mahasiswaId)->with('mahasiswa.user')->get();
       
        return view('mahasiswa.riwayat.index', compact('bimbingan'));
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
