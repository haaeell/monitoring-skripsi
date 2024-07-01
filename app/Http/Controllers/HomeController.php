<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahDosen = Pembimbing::count();
        $jumlahMahasiswa = Mahasiswa::count();
        return view('home', compact('jumlahDosen', 'jumlahMahasiswa'));
    }
}
