<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class GudangController extends Controller
{
 
    public function create(): View
    {
        $produk = Produk::all(); // Ambil semua data produk
        $viewinventory = Inventory::with('produk')->orderBy('idbarang', 'desc')
        ->latest()
        ->paginate(15);
        return view('Gudang.inventory', compact('viewinventory', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasigudang' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qtty' => ['required', 'numeric', 'min:0'],
        ]);

        $inventory = Inventory::create([
            'lokasigudang' => $request->lokasigudang,
            'tanggal' => $request->tanggal,
            'idbarang' => $request->idbarang,
            'qtty' => $request->qtty,
        ]);

        return redirect()->back()->with('success', 'Data inventory berhasil ditambahkan');
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'namabarang' => ['required','string','max:255'],
            'harga' => ['required','numeric','min:0'],
        ]);

        Produk::create([
            'namabarang' => $request->namabarang,
            'harga' => $request->harga,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }
    

}
