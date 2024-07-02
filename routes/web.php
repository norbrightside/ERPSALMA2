<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\Sale;
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
    Route::get('viewjadwal', [ProduksiController::class, 'viewjadwal'])->name('viewjadwal');
    Route::get('addjadwal', [ProduksiController::class, 'addjadwal'])->name('addjadwal');
    Route::get('/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/produksi/store', [ProduksiController::class,'store'])->name('produksi.store');
    Route::patch('/produksi/{id}/updateStatus', [ProduksiController::class, 'updateStatus'])->name('produksi.updateStatus');
});

Route::middleware('Gudang')->group(function() {
    Route::get('viewinventory', [GudangController::class, 'create'])->name('viewinventory');
Route::get('/gudang/create', [GudangController::class, 'create'])->name('gudang.create');
Route::post('/inventory/store', [GudangController::class, 'store'])->name('inventory.store');
Route::post('/produk/store', [GudangController::class, 'storeProduk'])->name('produk.store');
Route::patch('/inventory/{id}/updateStatus', [GudangController::class, 'updateStatus'])->name('inventory.updateStatus');

  
});
Route::middleware('Sale')->group(function() {
    Route::get('viewsales', [SaleController::class, 'create'])
    ->name('viewsales');
    Route::get('sales/addsale', [SaleController::class, 'createsales'])->name('addsale');
    Route::get('sales/confirmsale', [SaleController::class, 'confirmsales'])->name('confirmsale');
    Route::get('/penjualan/create', [SaleController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan/store', [SaleController::class, 'store'])->name('penjualan.store');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::patch('/sales/{id}/updateStatus', [SaleController::class, 'updateStatus'])->name('sales.updateStatus');
    Route::get('/formcetakfakturpenjualan/{id}', [SaleController::class, 'showCetakFaktur'])->name('formcetakfakturpenjualan');
    Route::post('/cetakfakturpenjualan/{id}', [SaleController::class, 'cetakFaktur'])->name('cetakFaktur');
});
Route::middleware('Purchase')->group(function() {
    Route::get('viewpurchaselist', [PurchaseController::class, 'create'])->name('viewpurchaselist');
    Route::get('/pembelian/create', [PurchaseController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian/store', [PurchaseController::class, 'store'])->name('pembelian.store');
    Route::post('/pembelianpadi/store', [PurchaseController::class, 'storepadi'])->name('pembelianpadi.store');
    Route::get('/belipadi', [PurchaseController::class, 'showBelipadiForm'])->name('belipadi');
    Route::patch('/pembelian/{id}/updateStatus', [PurchaseController::class, 'updateStatus'])->name('pembelian.updateStatus');
    Route::get('/formcetakfaktur/{id}', [PurchaseController::class, 'showCetakFaktur'])->name('formcetakfaktur');
    Route::post('/cetakfaktur/{id}', [PurchaseController::class, 'cetakFaktur'])->name('cetakFaktur');

});

    Route::middleware('Admin')->group(function() {
        Route::get('/sales/report', [LaporanController::class, 'report'])->name('sales.report');
        Route::get('/sales/reportprint', [LaporanController::class, 'reportprintsale'])->name('sales.reportprint');

});
require __DIR__.'/auth.php';


