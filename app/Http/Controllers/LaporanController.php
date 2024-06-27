<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function create(): View
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        
        $viewlaporansales = Penjualan::with('produk', 'pelanggan')
            ->orderBy(DB::raw('CASE WHEN status = "Selesai" THEN 1 ELSE 2 END'))
            ->latest()
            ->paginate(15);
        
        return view('laporan.laporan', compact('viewlaporansales', 'pelanggan', 'produk'));
    }
}
