<?php

use App\Http\Controllers\MainController;
use App\Http\Livewire\Kategori\MainIndex;
use App\Http\Livewire\MasterData\BarangMainIndex;
use App\Http\Livewire\MasterData\CustomerMainIndex;
use App\Http\Livewire\MasterData\JenisMainIndex;
use App\Http\Livewire\MasterData\RlsBarangSupplier;
use App\Http\Livewire\MasterData\SatuanMainIndex;
use App\Http\Livewire\MasterData\SuplierMainIndex;
use App\Models\Satuan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('backend')->name('backend.')->group(function () {
        Route::get('/', [MainController::class, 'main'])->name('main');

        Route::prefix('/master-data')->group(function() {
            Route::get('/jenis', JenisMainIndex::class)->name('master-jenis');
            Route::get('/satuan', SatuanMainIndex::class)->name('master-satuan');
            Route::get('/barang', BarangMainIndex::class)->name('master-barang');

            Route::get('/suplier', SuplierMainIndex::class)->name('master-suplier');
            Route::get('/customer', CustomerMainIndex::class)->name('master-customer');
        });

        Route::get('/relasi-barang-supplier', RlsBarangSupplier::class)->name('relasi-barang-supplier');
    });
});

