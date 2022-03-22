<?php

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPPController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/petugas/{petugas:id}', [PetugasController::class, 'data'])->name('datapetugas');
Route::post('/kelas', [KelasController::class, 'data'])->name('datakelas');
Route::post('/spp', [SPPController::class, 'data'])->name('dataspp');
Route::post('/laporan', [LaporanController::class, 'data'])->name('datalaporan');
Route::post('/spp/{spp:id}', [SPPController::class, 'data'])->name('dataspp');
Route::get('/siswa/{siswa:id}', function($id){
        $siswa = Siswa::with('spp')->findOrFail($id);
        return response()->json([
            'nominal' => $siswa->spp->nominal,
        ]);
});
