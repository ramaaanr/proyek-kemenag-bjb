<?php

use App\Http\Controllers\PerempuanController;
use App\Http\Controllers\PriaController;
use App\Http\Controllers\PernikahanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\PerkawinanController;
use App\Http\Controllers\PeristiwaPerkawinanController;
use App\Http\Controllers\PendidikanPerkawinanController;
use App\Http\Controllers\KursusCalonPengantinController;
use App\Http\Controllers\UsiaPengantinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users/login', [UserController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/logout', [UserController::class, 'logout']);
});
Route::get('/pernikahan', [PernikahanController::class, 'index']);
Route::get('/pernikahan/{id}', [PernikahanController::class, 'show']);
Route::post('/pernikahan', [PernikahanController::class, 'store']);
Route::delete('/pernikahan/{id}', [PernikahanController::class, 'destroy']);
Route::patch('/pernikahan/{id}', [PernikahanController::class, 'update']);

Route::get('/prias', [PriaController::class, 'getAll']);
Route::post('/prias', [PriaController::class, 'store']);
Route::get('/prias/{id}', [PriaController::class, 'getDetail']);
Route::put('/prias/{id}', [PriaController::class, 'update']);
Route::delete('/prias/{id}', [PriaController::class, 'delete']);


Route::get('/perempuans', [PerempuanController::class, 'getAll']);
Route::post('/perempuans', [PerempuanController::class, 'store']);
Route::get('/perempuans/{id}', [PerempuanController::class, 'getDetail']);
Route::put('/perempuans/{id}', [PerempuanController::class, 'update']);
Route::delete('/perempuans/{id}', [PerempuanController::class, 'delete']);



Route::get('laporan', [LaporanController::class, 'index']); // Menampilkan semua laporan
Route::post('laporan', [LaporanController::class, 'store']); // Menambahkan laporan baru
Route::get('laporan/{id}', [LaporanController::class, 'show']); // Menampilkan laporan berdasarkan ID
Route::put('laporan/{id}', [LaporanController::class, 'update']); // Memperbarui laporan berdasarkan ID
Route::delete('laporan/{id}', [LaporanController::class, 'destroy']); // Menghapus laporan berdasarkan ID
Route::get('laporan/check/{tahun}/{bulan}', [LaporanController::class, 'checkLaporan']);
Route::post('/laporan/{id}/ajukan', [LaporanController::class, 'ajukanLaporan']);

Route::post('/laporan/{id}/setujui', [LaporanController::class, 'setujuiLaporan']);
Route::post('/laporan/{id}/tolak', [LaporanController::class, 'tolakLaporan']);
Route::post('/laporan/{id}/pending', [LaporanController::class, 'pendingLaporan']);


Route::get('kelurahan', [KelurahanController::class, 'index']); // Menampilkan semua kelurahan
Route::post('kelurahan', [KelurahanController::class, 'store']); // Menambahkan kelurahan baru
Route::get('kelurahan/{id}', [KelurahanController::class, 'show']); // Menampilkan kelurahan berdasarkan ID
Route::put('kelurahan/{id}', [KelurahanController::class, 'update']); // Memperbarui kelurahan berdasarkan ID
Route::delete('kelurahan/{id}', [KelurahanController::class, 'destroy']); // Menghapus kelurahan berdasarkan ID

Route::get('perkawinan', [PerkawinanController::class, 'index']); // Menampilkan semua perkawinan
Route::post('perkawinan', [PerkawinanController::class, 'store']); // Menambahkan perkawinan baru
Route::get('perkawinan/{id}', [PerkawinanController::class, 'show']); // Menampilkan perkawinan berdasarkan ID
Route::get('perkawinan/check/{id}', [PerkawinanController::class, 'check']); // Menampilkan perkawinan berdasarkan ID
Route::put('perkawinan/update/{id}', [PerkawinanController::class, 'update']); // Memperbarui perkawinan berdasarkan ID
Route::delete('perkawinan/{id}', [PerkawinanController::class, 'destroy']); // Menghapus perkawinan berdasarkan ID

Route::get('peristiwa-perkawinan', [PeristiwaPerkawinanController::class, 'index']); // Menampilkan semua peristiwa perkawinan
Route::post('peristiwa-perkawinan', [PeristiwaPerkawinanController::class, 'store']); // Menambahkan peristiwa perkawinan baru
Route::get('peristiwa-perkawinan/{id}', [PeristiwaPerkawinanController::class, 'show']); // Menampilkan peristiwa perkawinan berdasarkan ID
Route::put('peristiwa-perkawinan/update/{id}', [PeristiwaPerkawinanController::class, 'update']); // Memperbarui peristiwa perkawinan berdasarkan ID
Route::delete('peristiwa-perkawinan/{id}', [PeristiwaPerkawinanController::class, 'destroy']); // Menghapus peristiwa perkawinan berdasarkan ID
Route::get('peristiwa-perkawinan/check/{id}', [PeristiwaPerkawinanController::class, 'check']); // Menampilkan perkawinan berdasarkan ID

Route::get('pendidikan-perkawinan', [PendidikanPerkawinanController::class, 'index']); // Menampilkan semua pendidikan perkawinan
Route::post('pendidikan-perkawinan', [PendidikanPerkawinanController::class, 'store']); // Menambahkan pendidikan perkawinan baru
Route::get('pendidikan-perkawinan/{id}', [PendidikanPerkawinanController::class, 'show']); // Menampilkan pendidikan perkawinan berdasarkan ID
Route::put('pendidikan-perkawinan/update/{id}', [PendidikanPerkawinanController::class, 'update']); // Memperbarui pendidikan perkawinan berdasarkan ID
Route::delete('pendidikan-perkawinan/{id}', [PendidikanPerkawinanController::class, 'destroy']); // Menghapus pendidikan perkawinan berdasarkan ID
Route::get('pendidikan-perkawinan/check/{id}', [PendidikanPerkawinanController::class, 'check']); // Menghapus pendidikan perkawinan berdasarkan ID

Route::get('kursus-calon-pengantin', [KursusCalonPengantinController::class, 'index']); // Menampilkan semua kursus calon pengantin
Route::post('kursus-calon-pengantin', [KursusCalonPengantinController::class, 'store']); // Menambahkan kursus calon pengantin baru
Route::get('kursus-calon-pengantin/{id}', [KursusCalonPengantinController::class, 'show']); // Menampilkan kursus calon pengantin berdasarkan ID
Route::get('kursus-calon-pengantin/check/{id}', [KursusCalonPengantinController::class, 'check']); // Menampilkan kursus calon pengantin berdasarkan ID
Route::put('kursus-calon-pengantin/update/{id}', [KursusCalonPengantinController::class, 'update']); // Memperbarui kursus calon pengantin berdasarkan ID
Route::delete('kursus-calon-pengantin/{id}', [KursusCalonPengantinController::class, 'destroy']); // Menghapus kursus calon pengantin berdasarkan ID

Route::get('usia-pengantin', [UsiaPengantinController::class, 'index']); // Menampilkan semua usia pengantin
Route::post('usia-pengantin', [UsiaPengantinController::class, 'store']); // Menambahkan usia pengantin baru
Route::get('usia-pengantin/{id}', [UsiaPengantinController::class, 'show']); // Menampilkan usia pengantin berdasarkan ID
Route::get('usia-pengantin/check/{id}', [UsiaPengantinController::class, 'check']); // Menampilkan usia pengantin berdasarkan ID
Route::put('usia-pengantin/update/{id}', [UsiaPengantinController::class, 'update']); // Memperbarui usia pengantin berdasarkan ID
Route::delete('usia-pengantin/{id}', [UsiaPengantinController::class, 'destroy']); // Menghapus usia pengantin berdasarkan ID

Route::post('/perempuans', [PerempuanController::class, 'store']);
