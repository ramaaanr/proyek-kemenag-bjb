<?php

use App\Http\Controllers\PernikahanController;
use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\LaporanController;



Route::get('/login', function () {
    // Jika sudah login, redirect ke dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('auth.login');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/user-session', [UserController::class, 'getUserSession'])->name('user.session');

Route::middleware(['auth'])->group(function () {
    Route::prefix('laporan')->group(function () {
        Route::get('/bulanan/export-pdf', [LaporanController::class, 'exportBulananPDF'])->name('laporan.bulanan.pdf');
        Route::get('/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
        Route::get('/tahunan', [LaporanController::class, 'laporanTahunan'])->name('laporan.tahunan');
        Route::get('/kecamatan', [LaporanController::class, 'laporanKecamatan'])->name('laporan.kecamatan');
        Route::get('/usia', [LaporanController::class, 'laporanUsia'])->name('laporan.usia');
        Route::get('/tren', [LaporanController::class, 'laporanTren'])->name('laporan.tren');
        Route::get('/peta', [LaporanController::class, 'laporanPeta'])->name('laporan.peta');
        Route::get('/user', [LaporanController::class, 'laporanUser'])->name('laporan.user');
        Route::get('/pendidikan', [LaporanController::class, 'laporanPendidikan'])->name('laporan.pendidikan');
    });
    Route::get('/dashboard', function () {
        return view('laporan.index');
    })->name('dashboard');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/pria', function () {
        return view('pria.index');
    });

    Route::get('/pria/tambah', function () {
        return view('pria.form');
    });
    Route::get('/pria/edit/{id}', function () {
        return view('pria.edit');
    });

    Route::get('/perempuan', function () {
        return view('perempuan.index');
    });

    Route::get('/perempuan/tambah', function () {
        return view('perempuan.form');
    });
    Route::get('/perempuan/edit/{id}', function () {
        return view('perempuan.edit');
    });


    Route::get('/laporan', function () {
        return view('laporan.index');
    });
    Route::get('/laporan-bulanan', function () {
        return view('laporan-bulanan.index');
    });
    Route::get('/laporan/tambah', function () {
        return view('laporan.form');
    });
    Route::get('/laporan/cetak/{id}', function () {
        return view('laporan.cetak');
    });
    Route::get('/laporan/lihat/{id}', function () {
        return view('laporan.detail');
    });

    Route::get('/review-laporan', function () {
        return view('review-laporan.index');
    });
    Route::get('/pernikahan', function () {
        return view('pernikahan.index');
    });
    Route::get('/pernikahan/lihat/{id}', function () {
        return view('pernikahan.detail');
    });
    Route::get('/pernikahan/tambah', [PernikahanController::class, 'showViewForm'])->name('pernikahan.form');
    Route::get('/pernikahan/edit/{id}', [PernikahanController::class, 'showViewEdit'])->name('pernikahan.edit');
    Route::get('/perkawinan/{id}', function () {
        return view('perkawinan.index');
    });
    Route::get('/perkawinan', function () {
        return view('perkawinan.view');
    });
    Route::get('/peristiwa_perkawinan/{id}', function () {
        return view('peristiwa_perkawinan.index');
    });
    Route::get('/peristiwa-perkawinan', function () {
        return view('peristiwa_perkawinan.view');
    });
    Route::get('/pendidikan_perkawinan/{id}', function () {
        return view('pendidikan_perkawinan.index');
    });
    Route::get('/pendidikan-perkawinan/', function () {
        return view('pendidikan_perkawinan.view');
    });
    Route::get('/kursus_calon_pengantin/{id}', function () {
        return view('kursus_calon_pengantin.index');
    });
    Route::get('/kursus-calon-pengantin/', function () {
        return view('kursus_calon_pengantin.view');
    });
    Route::get('/usia_pengantin/{id}', function () {
        return view('usia_pengantin.index');
    });
    Route::get('/usia-pengantin/', function () {
        return view('usia_pengantin.view');
    });
});
