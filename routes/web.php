<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\produksiController;
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

require __DIR__.'/auth.php';


route::get('admin/dashboard',[HomeController::class, 'index'])->middleware(['auth', 'Admin']);
route::get('sale/dashboard',[SaleController::class, 'index'])->middleware(['auth', 'Sale']);
route::get('Purchase/dashboard',[PurchaseController::class, 'index'])->middleware(['auth', 'Purchase']);
route::get('Gudang/dashboard',[GudangController::class, 'index'])->middleware(['auth', 'Gudang']);
route::get('Produksi/dashboard',[ProduksiController::class, 'index'])->middleware(['auth', 'Produksi']);
