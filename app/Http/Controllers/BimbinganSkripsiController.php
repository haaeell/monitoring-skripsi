<?php

namespace App\Http\Controllers;

use App\Models\BimbinganSkripsi;
use App\Models\Mahasiswa;
use App\Notifications\BimbinganBaruNotification;
use App\Notifications\BalasanBimbinganNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'mhs') {

            $bimbinganSkripsi = BimbinganSkripsi::with('mahasiswa')->get();
            return view('bimbingan_skripsi.index', compact('bimbinganSkripsi'));
        } else {

            $pembimbing = $user->pembimbing;
            $mahasiswas = $pembimbing->mahasiswa()->get();

            $bimbinganSkripsi = null;
            if ($request->has('mahasiswa_id')) {
                $mahasiswa_id = $request->input('mahasiswa_id');
                $bimbinganSkripsi = BimbinganSkripsi::where('mahasiswa_id', $mahasiswa_id)->with('mahasiswa')->get();
            }

            return view('bimbingan_skripsi.index', compact('mahasiswas', 'bimbinganSkripsi'));
        }
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

        $bimbingan = BimbinganSkripsi::create($validatedData);

        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $pembimbing = $mahasiswa->pembimbing;
        if ($pembimbing && $pembimbing->user) {
            $pembimbing->user->notify(new BimbinganBaruNotification($bimbingan));
        }
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

        $user = auth()->user();
        $notification = $user->unreadNotifications->firstWhere('data.bimbingan_id', $bimbinganSkripsi->id);
        if ($notification) {
            $notification->markAsRead();
        }

        $mahasiswa = $bimbinganSkripsi->mahasiswa;
        $mahasiswa->user->notify(new BalasanBimbinganNotification($bimbinganSkripsi));

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
