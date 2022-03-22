<?php

use App\Http\Controllers\SPPController;
use App\Http\Controllers\KelasController;

Route::resource('/spp', SPPController::class);
Route::group(['prefix' => 'spp', 'as' => 'spp,'], function () {
    Route::post('/tambah', [SPPController::class, 'store'])->name('store');
    Route::get('{petugas:id}/edit', [SPPController::class, 'edit'])->name('edit');
    Route::post('{petugas:id}/edit', [SPPController::class, 'update'])->name('update');
    Route::post('/{spp:id}', [SPPController::class, 'destroy'])->name('destroy');
});
