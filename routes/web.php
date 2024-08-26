<?php

use App\Http\Controllers\DataMasterController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['middleware' => ['role:kabag']], function () {
    Route::group(['prefix' => 'master-data'], function () {
        Volt::route('kode', 'master.kode')->name('kode');
        Volt::route('satuan', 'master.satuan')->name('satuan');
        Volt::route('vendor', 'master.vendor')->name('vendor');
        Volt::route('unit', 'master.unit')->name('unit');
        Volt::route('tipe-merek', 'master.tipe-merek')->name('tipe-merek');
        Volt::route('tipe', 'master.tipe-merek.tipe')->name('tipe');
        Volt::route('merek', 'master.tipe-merek.merek')->name('merek');

        // Route::get('data-merek', [DataMasterController::class, 'getMerek'])->name('data-merek');
        // Route::get('data-tipe', [DataMasterController::class,  'getTipe'])->name('data-tipe');
        Route::get('data-merek', function (\App\Models\Merek $merek) {
            return $merek->get();
        })->name('data-merek');
        Route::get('data-tipe', function (\App\Models\Tipe $tipe) {
            return $tipe->get();
        })->name('data-tipe');
    });

    Route::group(['prefix' => 'master-aset'], function () {
        Volt::route('aset', 'master.aset')->name('aset');
        Route::get('data-kode', [DataMasterController::class,                 'getKode'])->name('data-kode');
        Route::get('data-vendor', [DataMasterController::class,               'getVendor'])->name('data-vendor');
        Route::get('data-satuan', [DataMasterController::class,               'getSatuan'])->name('data-satuan');
        Route::get('data-tipe-merek', [DataMasterController::class,           'getTipeMerek'])->name('data-tipe-merek');
        Route::get('data-tipe-merek-name/{id}', [DataMasterController::class, 'getTipeMerekName'])->name('data-tipe-merek-name');
        Route::get('data-unit', [DataMasterController::class,                 'getUnit'])->name('data-unit');
    });
})->middleware(['auth']);

require __DIR__ . '/auth.php';
