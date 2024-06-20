<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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
});

Route::middleware('Gudang')->group(function() {
    Route::get('viewinventory', [GudangController::class, 'create'])
    ->name('viewinventory');

  
});
Route::middleware('Sale')->group(function() {
    Route::get('viewsales', [SaleController::class, 'create'])
    ->name('viewsales');
  
});
Route::middleware('Purchase')->group(function() {
    Route::get('viewpurchaselist', [PurchaseController::class, 'create'])
    ->name('viewpurchaselist');
  
});
require __DIR__.'/auth.php';


