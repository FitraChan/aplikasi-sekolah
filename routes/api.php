<?php

use App\Http\Controllers\pendaftaran\CalonSiswaController;
use App\Http\Controllers\api\orangTua\UserController;
use App\Http\Controllers\api\orangTua\AbsenController;
use App\Http\Controllers\api\orangTua\BayarController;
use App\Http\Controllers\api\orangTua\PengumumanController;
use App\Http\Controllers\keuangan\BayarCalonSiswaController;
use App\Http\Controllers\api\orangTua\TugasController;





use Illuminate\Support\Facades\Route;


Route::post('/calon-siswa/notifyPembayaran', [BayarCalonSiswaController::class, 'notifyPembayaran'])
        ->name('calon-siswa.notifyPembayaran');


Route::post('/notifyPembayaranSiswa', [BayarController::class, 'notifyPembayaranSiswa'])
        ->name('notifyPembayaranSiswa');

Route::post('/login-siswa', [UserController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:siswa'])->group(function () {
        Route::get('/absensi', [AbsenController::class, 'index']);
        Route::get('/pembayaran', [BayarController::class, 'index']);
        Route::get('/itemBayar', [BayarController::class, 'itemBayar']);
        Route::post('/simpanIpaymu', [BayarController::class, 'simpanIpaymu'])->name('simpanIpaymu');

        Route::get('/pengumuman', [
                PengumumanController::class,
                'index'
        ]);

        Route::get('/pengumuman/{id}', [
                PengumumanController::class,
                'show'
        ]);

        Route::get('/tugas', [TugasController::class, 'index']);
        Route::get('/transkelas/{id}', [TugasController::class, 'transkelas'])->name('transkelas');
        Route::post('/simpantugas', [TugasController::class, 'simpantugas'])->name('simpantugas');
        Route::get('/jadwal', [TugasController::class, 'jadwal'])->name('jadwal');;



        // Tambahkan route terproteksi khusus calon siswa lainnya di sini...
});
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/absensi', [AbsenController::class, 'index']);
// });

//require __DIR__ . '/web.php';
