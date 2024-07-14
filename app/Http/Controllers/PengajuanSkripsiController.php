<?php
namespace App\Http\Controllers;

use App\Models\PengajuanSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanSkripsiController extends Controller
{
    public function create()
    {
        $riwayatPengajuanSkripsi = PengajuanSkripsi::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get();
        return view('judul_skripsi.index', compact('riwayatPengajuanSkripsi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_skripsi' => 'required|string|max:255',
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
            'status' => 'pending',
        ]);

        return redirect()->route('pengajuan-skripsi.create')->with('success', 'Pengajuan judul skripsi berhasil disimpan.');
    }

    public function approve($id)
    {
        $pengajuanSkripsi = PengajuanSkripsi::findOrFail($id);
        $pengajuanSkripsi->status = 'diterima';
        $pengajuanSkripsi->catatan_ditolak = null;
        $pengajuanSkripsi->save();

        return redirect()->back()->with('success', 'Judul skripsi telah disetujui.');
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
