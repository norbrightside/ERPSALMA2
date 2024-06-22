<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function create(): View
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        $viewsales = Penjualan::with('produk', 'pelanggan')->get(); // Ambil semua jadwal dari database
        return view('Sale.order', compact('viewsales', 'pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalpenjualan' => ['required', 'date'],
            'idpelanggan' => ['required', 'exists:pelanggan,idpelanggan'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'nilaitransaksi' => ['required', 'numeric', 'min:0'],
            'qttypenjualan' => ['required', 'numeric', 'min:0'],
        ]);

        Penjualan::create([
            'tanggalpenjualan' => $request->tanggalpenjualan,
            'idpelanggan' => $request->idpelanggan,
            'idbarang' => $request->idbarang,
            'nilaitransaksi' => $request->nilaitransaksi,
            'qttypenjualan' => $request->qttypenjualan,
        ]);

        return redirect()->back()->with('success', 'Penjualan berhasil ditambahkan');
    }
}
