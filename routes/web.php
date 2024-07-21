<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
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



Route::post('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::post('/', function () {return view('dashboard');});
    Route::post('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('Produksi')->group(function() {
    Route::post('jadwal', [ProduksiController::class, 'create'])
    ->name('jadwalProduksi');
    Route::post('/produksi/jadwal', [ProduksiController::class, 'postJadwalProduksi'])->name('produksi.jadwal');
    Route::post('/produksi/report', [LaporanController::class, 'reportproduksi'])->name('produksi.report');
    Route::post('viewjadwal', [ProduksiController::class, 'viewjadwal'])->name('viewjadwal');
    Route::post('addjadwal', [ProduksiController::class, 'addjadwal'])->name('addjadwal');
    Route::post('/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/produksi/store', [ProduksiController::class,'store'])->name('produksi.store');
    Route::patch('/produksi/{id}/updateStatus', [ProduksiController::class, 'updateStatus'])->name('produksi.updateStatus');
    Route::post('/produksi/reportprint', [LaporanController::class, 'reportprintproduksi'])->name('produksi.reportprint');
});

Route::middleware('Gudang')->group(function() {
    Route::post('viewinventory', [GudangController::class, 'create'])->name('viewinventory');
    Route::post('addinventory', [GudangController::class, 'showAddInventoryForm'])->name('addinventory');;
    Route::post('listinventory', [GudangController::class, 'creategudang'])->name('listinventory');
    Route::post('/stock/highlight', [GudangController::class, 'highlightStock'])->name('stock.highlight');

Route::post('/gudang/create', [GudangController::class, 'create'])->name('gudang.create');
Route::post('/inventory/store', [GudangController::class, 'store'])->name('inventory.store');
Route::post('/produk/store', [GudangController::class, 'storeProduk'])->name('produk.store');
Route::patch('/inventory/{id}/updateStatus', [GudangController::class, 'updateStatus'])->name('inventory.updateStatus');

  
});
Route::middleware('Sale')->group(function() {
    Route::post('/sales/highlight', [SaleController::class, 'postSalesHighlight'])->name('sales.highlight');
    Route::post('viewsales', [SaleController::class, 'create'])
    ->name('viewsales');
    Route::post('sales/addsale', [SaleController::class, 'createsales'])->name('addsale');
    Route::post('sales/confirmsale', [SaleController::class, 'confirmsales'])->name('confirmsale');
    Route::post('/penjualan/create', [SaleController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan/store', [SaleController::class, 'store'])->name('penjualan.store');
    Route::post('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::patch('/sales/{id}/updateStatus', [SaleController::class, 'updateStatus'])->name('sales.updateStatus');
    Route::post('/formcetakfakturpenjualan/{id}', [SaleController::class, 'showCetakFaktur'])->name('formcetakfakturpenjualan');
    Route::post('/cetakfakturpenjualan/{id}', [SaleController::class, 'cetakFaktur'])->name('cetakFakturpenjualan');
    Route::post('/sales/report', [LaporanController::class, 'report'])->name('sales.report');
        
    Route::post('/sales/reportprint', [LaporanController::class, 'reportprintsale'])->name('sales.reportprint');
});
Route::middleware('Purchase')->group(function() {
    Route::post('viewpurchaselist', [PurchaseController::class, 'create'])->name('viewpurchaselist');
    Route::post('/purchaseproduk', [PurchaseController::class, 'showAddPembelianForm'])->name('purchaseproduk');
    Route::post('/purchasepadi', [PurchaseController::class, 'showAddPembelianPadiForm'])->name('purchasepadi');
    Route::post('purchaselist', [PurchaseController::class, 'createpembelian'])->name('purchaselist');
    Route::post('/pembelian/highlight-today', [PurchaseController::class, 'highlightPembelianToday'])->name('pembelian.highlight.today');

    Route::post('/pembelian/create', [PurchaseController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian/store', [PurchaseController::class, 'store'])->name('pembelian.store');
    Route::post('/pembelianpadi/store', [PurchaseController::class, 'storepadi'])->name('pembelianpadi.store');
    Route::post('/belipadi', [PurchaseController::class, 'showBelipadiForm'])->name('belipadi');
    Route::patch('/pembelian/{id}/updateStatus', [PurchaseController::class, 'updateStatus'])->name('pembelian.updateStatus');
    Route::post('/formcetakfaktur/{id}', [PurchaseController::class, 'showCetakFaktur'])->name('formcetakfaktur');
    Route::post('/cetakfaktur/{id}', [PurchaseController::class, 'cetakFaktur'])->name('cetakFaktur');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('addsupplier');

});

    Route::middleware('Admin')->group(function() {
        
       
       
});
require __DIR__.'/auth.php';


