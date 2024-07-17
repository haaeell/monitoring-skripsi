<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('pembimbing')->get();
        $totalMahasiswa = $mahasiswas->count();
    
        return view('lno.data.index', compact('mahasiswas', 'totalMahasiswa'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lno.data.create_mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'angkatan' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'required|email|unique:users,email',
            'telp' => 'required',
            'alamat' => 'required',
            'pembimbing_id' => 'nullable|exists:pembimbing,id',
            'penguji1_id' => 'nullable|exists:pembimbing,id',
            'penguji2_id' => 'nullable|exists:pembimbing,id',
        ]);

        // Create Mahasiswa
        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'), // Set a default password or use Hash facade
            'role' => 'mahasiswa',
        ]);

        $mahasiswa = Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'angkatan' => $request->input('angkatan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            'alamat' => $request->input('alamat'),
            'pembimbing_id' => $request->input('pembimbing_id'),
            'penguji1_id' => $request->input('penguji1_id'),
            'penguji2_id' => $request->input('penguji2_id'),
        ]);

        return redirect()->route('users.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);

    $request->validate([
        'nim' => 'required|unique:mahasiswa,nim,' . $id,
        'nama' => 'required',
        'angkatan' => 'required',
        'jenis_kelamin' => 'required|in:L,P',
        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($mahasiswa->user_id),
        ],
        'telp' => 'required',
        'alamat' => 'required',
        'pembimbing_id' => 'nullable|exists:pembimbing,id',
        'penguji1_id' => 'nullable|exists:pembimbing,id',
        'penguji2_id' => 'nullable|exists:pembimbing,id',
    ]);

    DB::beginTransaction();

    try {
        // Update User
        $user = $mahasiswa->user;
        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
        ]);

        // Update Mahasiswa
        $mahasiswa->update([
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'angkatan' => $request->input('angkatan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            'alamat' => $request->input('alamat'),
            'pembimbing_id' => $request->input('pembimbing_id'),
            'penguji1_id' => $request->input('penguji1_id'),
            'penguji2_id' => $request->input('penguji2_id'),
        ]);

        DB::commit();

        return redirect()->route('users.index')->with('success', 'Mahasiswa berhasil diupdate');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('users.index')->with('error', 'Terjadi kesalahan saat mengupdate Mahasiswa: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
