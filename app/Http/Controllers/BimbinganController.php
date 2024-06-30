<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BimbinganSkripsi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswaBimbingan = Mahasiswa::where('pembimbing_id', Auth::user()->pembimbing->id)->with('user')->get();
        return view('mahasiswa.bimbingan.index',compact('mahasiswaBimbingan'));
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
        $validatedData = $request->validate([
            'keterangan' => 'required|string', // Atur sesuai kebutuhan validasi
        ]);

        try {
            // Cari mahasiswa berdasarkan ID
            $mahasiswa = Mahasiswa::findOrFail($id);

            // Update keterangan
            $mahasiswa->keterangan = $validatedData['keterangan'];
            $mahasiswa->save();

            // Response jika berhasil
            return response()->json(['message' => 'Keterangan mahasiswa berhasil diperbarui.']);

        } catch (\Exception $e) {
            // Response jika terjadi error
            return response()->json(['error' => 'Gagal memperbarui keterangan mahasiswa: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
