<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\GudangController;

use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('Produksi')->group(function() {
    Route::get('jadwal', [ProduksiController::class, 'create'])
    ->name('jadwalProduksi');
    Route::get('/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/produksi/store', [ProduksiController::class,'store'])->name('produksi.store');

});

Route::middleware('Gudang')->group(function() {
    Route::get('viewinventory', [GudangController::class, 'create'])
    ->name('viewinventory');

Route::get('/gudang/create', [GudangController::class, 'create'])->name('gudang.create');
Route::post('/inventory/store', [GudangController::class, 'store'])->name('inventory.store');

Route::post('/produk/store', [GudangController::class, 'storeProduk'])->name('produk.store');

  
});
Route::middleware('Sale')->group(function() {
    Route::get('viewsales', [SaleController::class, 'create'])
    ->name('viewsales');
    Route::get('/penjualan/create', [SaleController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan/store', [SaleController::class, 'store'])->name('penjualan.store');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
});
Route::middleware('Purchase')->group(function() {
    Route::get('viewpurchaselist', [PurchaseController::class, 'create'])
    ->name('viewpurchaselist');
    Route::get('/pembelian/create', [PurchaseController::class, 'create'])
    ->name('pembelian.create');
    Route::post('/pembelian/store', [PurchaseController::class, 'store'])->name('pembelian.store');
});
require __DIR__.'/auth.php';


