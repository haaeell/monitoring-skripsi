<?php

namespace App\Http\Controllers;

use App\Models\BimbinganSkripsi;
use App\Models\JadwalUjian;
use App\Models\Pembimbing;
use App\Models\PengajuanSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */ public function index()
    {
        if (Auth::user()->role == 'mahasiswa') {
            $penguji = Pembimbing::all();
            $mahasiswa = Auth::user()->mahasiswa;
            $judulSkripsi = PengajuanSkripsi::where('mahasiswa_id', $mahasiswa->id)
                ->where('status', 'diterima')
                ->first();
            $jadwalUjian = JadwalUjian::where('mahasiswa_id', $mahasiswa->id)->get();
            $jumlahBimbingan = BimbinganSkripsi::where('mahasiswa_id', $mahasiswa->id)->count();

            return view('jadwal_ujian.index', compact('penguji', 'judulSkripsi', 'jadwalUjian', 'mahasiswa', 'jumlahBimbingan'));
        }

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'pembimbing') {
            $jadwalUjian = JadwalUjian::all();
            return view('jadwal_ujian.index', compact('jadwalUjian'));
        }
    }
    public function setujui(Request $request, $id)
    {
        $request->validate([
            'ruangan' => 'required|string|max:255',
        ]);

        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->update([
            'status' => 'diterima',
            'ruangan' => $request->ruangan,
        ]);

        return redirect()->route('jadwal-ujian.index')->with('success', 'Jadwal ujian berhasil disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->update([
            'status' => 'ditolak',
            'catatan_ditolak' => $request->catatan,
        ]);

        return redirect()->route('jadwal-ujian.index')->with('success', 'Jadwal ujian berhasil ditolak.');
    }
    /**
     * Show the form for creating a new resource.
     */


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
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:Proposal,Pendadaran',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'ruangan' => 'nullable|string|max:255',
            'penguji1_id' => 'required|exists:pembimbing,id',
            'penguji2_id' => 'required|exists:pembimbing,id',
        ]);

        JadwalUjian::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'ruangan' => $request->ruangan,
            'penguji1_id' => $request->penguji1_id,
            'penguji2_id' => $request->penguji2_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Jadwal ujian berhasil diajukan.');
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
