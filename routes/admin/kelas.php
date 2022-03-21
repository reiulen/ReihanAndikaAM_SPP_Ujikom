<?php

use App\Http\Controllers\KelasController;
use App\Models\Kelas;

Route::resource('/kelas', KelasController::class);
Route::group(['prefix' => 'kelas', 'as' => 'kelas,'], function () {
    Route::post('/tambah', [KelasController::class, 'store'])->name('store');
    Route::get('{petugas:id}/edit', [KelasController::class, 'edit'])->name('edit');
    Route::post('{petugas:id}/edit', [KelasController::class, 'update'])->name('update');
    Route::post('/{kelas:id}', [KelasController::class, 'destroy'])->name('destroy');
});
