<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\BimbinganSkripsiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('bimbingan', BimbinganController::class);
Route::resource('profile', ProfileController::class);
Route::resource('riwayat', RiwayatController::class);
Route::resource('users', UserController::class);
Route::resource('pesan', PesanController::class);
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('pembimbing', PembimbingController::class);
Route::resource('bimbingan-skripsi', BimbinganSkripsiController::class);
