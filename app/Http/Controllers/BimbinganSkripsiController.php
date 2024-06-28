<?php

namespace App\Http\Controllers;

use App\Models\BimbinganSkripsi;
use Illuminate\Http\Request;

class BimbinganSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bimbinganSkripsi = BimbinganSkripsi::with('mahasiswa')->get();
        return view('bimbingan_skripsi.index', compact('bimbinganSkripsi'));
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
        $validatedData = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'pembahasan_mhs' => 'required',
            'file' => 'nullable|file',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bimbingan_skripsi_files'), $fileName);
            $validatedData['file'] = 'bimbingan_skripsi_files/' . $fileName;
        }

        BimbinganSkripsi::create($validatedData);

        return redirect()->route('bimbingan-skripsi.index')->with('success', 'Bimbingan skripsi berhasil ditambahkan.');
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
    public function update(Request $request, BimbinganSkripsi $bimbinganSkripsi)
    {
       
        $validatedData = $request->validate([
            'pembahasan_dosen' => 'required',
        ]);
    
        $bimbinganSkripsi->pembahasan_dosen = $validatedData['pembahasan_dosen'];
        $bimbinganSkripsi->status = 'sudah dibaca';
        $bimbinganSkripsi->save();
    
        return redirect()->route('bimbingan-skripsi.index')->with('success', 'Pembahasan dan status bimbingan skripsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bimbinganSkripsi = BimbinganSkripsi::findOrFail($id);
        $bimbinganSkripsi->delete();

        return redirect()->route('bimbingan-skripsi.index')->with('success', 'Bimbingan skripsi berhasil dihapus.');
    }
}
