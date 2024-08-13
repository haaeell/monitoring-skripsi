<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use App\Models\PengajuanSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanSkripsiController extends Controller
{
    public function create()
    {
        $dpsList = Pembimbing::all();
        $riwayatPengajuanSkripsi = PengajuanSkripsi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get();
        return view('judul_skripsi.index', compact('riwayatPengajuanSkripsi','dpsList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_skripsi' => 'required|string|max:255',
            'abstrak' => 'required|string',
        ]);
        $judulDiterima = PengajuanSkripsi::where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->where('status', 'diterima')
            ->first();

        if ($judulDiterima) {
            return redirect()->route('pengajuan-skripsi.create')
                ->with('error', 'Maaf, Anda sudah memiliki judul yang diterima. Anda tidak bisa mengajukan lagi. Jika ingin mengganti judul, silakan hubungi admin.');
        }

        PengajuanSkripsi::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'judul_skripsi' => $request->judul_skripsi,
            'abstrak' => $request->abstrak,
            'status' => 'pending',
            'dps' => $request->dps
        ]);

        return redirect()->back()->with('success', 'Pengajuan judul skripsi berhasil disimpan.');
    }

    public function approve(Request $request, $id)
    {
        try {
            $pengajuanSkripsi = PengajuanSkripsi::findOrFail($id);
            $pengajuanSkripsi->status = 'diterima';
            $pengajuanSkripsi->catatan_ditolak = null;
            $pengajuanSkripsi->save();
        
            $mahasiswa = Mahasiswa::findOrFail($request->user_id); 
            $mahasiswa->penguji1_id = $request->penguji1_id;
            $mahasiswa->penguji2_id = $request->penguji2_id;
            $mahasiswa->pembimbing_id = $request->dps;
            $mahasiswa->save();
        
            return redirect()->back()->with('success', 'Judul skripsi telah disetujui dan dosen penguji telah dipilih.');
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui judul skripsi: ' . $e->getMessage());
        }
    }
    
    
    

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_ditolak' => 'required|string',
        ]);

        $pengajuanSkripsi = PengajuanSkripsi::findOrFail($id);
        $pengajuanSkripsi->status = 'ditolak';
        $pengajuanSkripsi->catatan_ditolak = $request->catatan_ditolak;
        $pengajuanSkripsi->save();

        return redirect()->back()->with('success', 'Judul skripsi telah ditolak dengan catatan.');
    }
}
