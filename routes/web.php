<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPPController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('index');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'proseslogin'])->name('proseslogin');
});

Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('/petugas', PetugasController::class);
        Route::resource('/siswa', SiswaController::class);
        include_once('admin/kelas.php');
        include_once('admin/spp.php');
    });
    Route::group(['middleware' => 'siswa'], function(){
        Route::resource('/transaksi', TransaksiController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
});

Route::group(['middleware' => 'bukanuser'], function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});
