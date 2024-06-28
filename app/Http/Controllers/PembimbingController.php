<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use App\Models\User;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembimbings = Pembimbing::all();
        return view('lno.data.index', compact('pembimbings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nik' => 'required|unique:pembimbing,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'jenis_kelamin' => 'required',
            'telp' => 'required|string|max:15',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'), 
        ]);
        $pembimbing = Pembimbing::create([
            'user_id' => $user->id,
            'nik' => $request->input('nik'),
            'nama' => $request->input('name'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telp' => $request->input('telp'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pembimbing berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('pembimbing.show', compact('pembimbing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('pembimbing.edit', compact('pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:pembimbing,nik,'.$id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'telp' => 'required|string|max:15',
        ]);

        $pembimbing = Pembimbing::findOrFail($id);
        $pembimbing->update($request->all());

        return redirect()->route('users.index')->with('success', 'Pembimbing berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        $pembimbing->delete();

        return redirect()->route('pembimbing.index')->with('success', 'Pembimbing berhasil dihapus.');
    }
}
