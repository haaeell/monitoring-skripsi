<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;

use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Redirect to the appropriate profile page based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->mahasiswa) {
            return redirect()->route('profile.mahasiswa', ['id' => $user->mahasiswa->id]);
        } elseif ($user->pembimbing) {
            return redirect()->route('profile.pembimbing', ['id' => $user->pembimbing->id]);
        }

        return redirect()->route('dashboard')->with('error', 'Role tidak dikenali.');
    }

    /**
     * Display the profile of a Mahasiswa.
     */
    public function showMahasiswaProfile($id)
    {
        $pembimbings = Pembimbing::all();
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('profile.mahasiswa', compact('mahasiswa','pembimbings'));
    }

    /**
     * Display the profile of a Pembimbing.
     */
    public function showPembimbingProfile($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('profile.pembimbing', compact('pembimbing'));
    }

    /**
     * Show the form for editing the profile of a Mahasiswa.
     */
    public function editMahasiswaProfile($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pembimbings = Pembimbing::all(); // Fetch all Pembimbing records
        return view('profile.edit_mahasiswa', compact('mahasiswa', 'pembimbings'));
    }

    /**
     * Show the form for editing the profile of a Pembimbing.
     */
    public function editPembimbingProfile($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('profile.edit_pembimbing', compact('pembimbing'));
    }

    /**
     * Update the profile of a Mahasiswa.
     */
    

     public function updateMahasiswaProfile(Request $request, $id)
     {
         $mahasiswa = Mahasiswa::findOrFail($id);
         $user = $mahasiswa->user;
     
         $request->validate([
             'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
             'nama' => 'required',
             'angkatan' => 'required',
             'jenis_kelamin' => 'required|in:L,P',
             'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
             'telp' => 'required',
             'alamat' => 'required',
             'judul_ta' => 'nullable|string',
             'pembimbing_id' => 'nullable|exists:pembimbing,id',
             'password' => 'nullable|min:8|confirmed',
             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:101010',
         ]);
     
         DB::beginTransaction();
     
         try {
             $user->update([
                 'name' => $request->input('nama'),
                 'email' => $request->input('email'),
                 'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
             ]);
     
             if ($request->hasFile('photo')) {
                 // Delete the old photo if exists
                 if ($mahasiswa->photo) {
                     Storage::delete(str_replace('/storage/', 'public/', $mahasiswa->photo));
                 }
     
                 // Store the new photo
                 $photoPath = $request->file('photo')->store('public/photos');
                 $mahasiswa->photo = Storage::url($photoPath);
             }
     
             $mahasiswa->update([
                 'nim' => $request->input('nim'),
                 'nama' => $request->input('nama'),
                 'angkatan' => $request->input('angkatan'),
                 'jenis_kelamin' => $request->input('jenis_kelamin'),
                 'email' => $request->input('email'),
                 'telp' => $request->input('telp'),
                 'alamat' => $request->input('alamat'),
                 'judul_ta' => $request->input('judul_ta'),
                 'pembimbing_id' => $request->input('pembimbing_id'),
                 'photo' => $mahasiswa->photo,
             ]);
     
             DB::commit();
     
             return redirect()->route('profile.mahasiswa', ['id' => $mahasiswa->id])->with('success', 'Profil Mahasiswa berhasil diperbarui.');
         } catch (\Exception $e) {
             DB::rollBack();
     
             return redirect()->route('profile.mahasiswa', ['id' => $mahasiswa->id])->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
         }
     }
    /**
     * Update the profile of a Pembimbing.
     */
    public function updatePembimbingProfile(Request $request, $id)
{
    $pembimbing = Pembimbing::findOrFail($id);
    $user = $pembimbing->user;

    $request->validate([
        'nik' => 'required|unique:pembimbing,nik,' . $pembimbing->id,
        'nama' => 'required',
        'jenis_kelamin' => 'required|in:L,P',
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        'telp' => 'required',
        'password' => 'nullable|min:8|confirmed',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:101010',
    ]);

    DB::beginTransaction();

    try {
        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
        ]);

        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($pembimbing->photo) {
                Storage::delete(str_replace('/storage/', 'public/', $pembimbing->photo));
            }

            // Store the new photo
            $photoPath = $request->file('photo')->store('public/photos');
            $pembimbing->photo = Storage::url($photoPath);
        }

        $pembimbing->update([
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telp' => $request->input('telp'),
            'photo' => $pembimbing->photo,
        ]);

        DB::commit();

        return redirect()->route('profile.pembimbing', ['id' => $pembimbing->id])->with('success', 'Profil Pembimbing berhasil diperbarui.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->route('profile.pembimbing', ['id' => $pembimbing->id])->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
    }
}
}
