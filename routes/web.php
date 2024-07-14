<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\BimbinganSkripsiController;
use App\Http\Controllers\JadwalUjianController;
use App\Http\Controllers\JudulSkripsiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PengajuanSkripsiController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('bimbingan', BimbinganController::class);
    Route::resource('judul-skripsi', JudulSkripsiController::class);
    Route::resource('jadwal-ujian', JadwalUjianController::class);

    Route::get('/pengajuan-skripsi', [PengajuanSkripsiController::class, 'create'])->name('pengajuan-skripsi.create');
Route::post('/pengajuan-skripsi', [PengajuanSkripsiController::class, 'store'])->name('pengajuan-skripsi.store');
Route::post('/pengajuan-skripsi/{id}/approve', [PengajuanSkripsiController::class, 'approve'])->name('pengajuan-skripsi.approve');
Route::post('/pengajuan-skripsi/{id}/reject', [PengajuanSkripsiController::class, 'reject'])->name('pengajuan-skripsi.reject');

Route::post('/jadwal-ujian/{id}/setujui', [JadwalUjianController::class, 'setujui'])->name('jadwal-ujian.setujui');
Route::post('/jadwal-ujian/{id}/tolak', [JadwalUjianController::class, 'tolak'])->name('jadwal-ujian.tolak');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/mahasiswa/{id}', [ProfileController::class, 'showMahasiswaProfile'])->name('profile.mahasiswa');
    Route::get('/profile/pembimbing/{id}', [ProfileController::class, 'showPembimbingProfile'])->name('profile.pembimbing');
    Route::get('/profile/mahasiswa/{id}/edit', [ProfileController::class, 'editMahasiswaProfile'])->name('profile.mahasiswa.edit');
    Route::put('/profile/mahasiswa/{id}', [ProfileController::class, 'updateMahasiswaProfile'])->name('profile.mahasiswa.update');

    Route::get('/profile/pembimbing/{id}/edit', [ProfileController::class, 'editPembimbingProfile'])->name('profile.pembimbing.edit');
    Route::put('/profile/pembimbing/{id}', [ProfileController::class, 'updatePembimbingProfile'])->name('profile.pembimbing.update');

    Route::get('/profile/admin/{id}/edit', [ProfileController::class, 'showAdminProfile'])->name('profile.admin');
    Route::put('/profile/admin/{id}', [ProfileController::class, 'updateAdminProfile'])->name('profile.admin.update');

    Route::resource('riwayat', RiwayatController::class);
    Route::resource('users', UserController::class);
    Route::resource('pesan', PesanController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('pembimbing', PembimbingController::class);
    Route::resource('bimbingan-skripsi', BimbinganSkripsiController::class);
    Route::get('/cetak-pdf', [RiwayatController::class, 'cetakPdf'])->name('cetak-pdf');   
    Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');  

    Route::get('/mark-as-read/{notification_id}', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    

});

