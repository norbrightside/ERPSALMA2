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
    {   $stok = DB::table('gudang')
        ->join('inventory', 'gudang.idgudang', '=', 'inventory.idgudang')
        ->join('produk', 'inventory.idbarang', '=', 'produk.idbarang')
        ->select('gudang.lokasigudang', 'produk.namabarang', DB::raw('SUM(CASE WHEN inventory.status = "diterima" THEN inventory.qtty ELSE 0 END) as total_qtty'))
        ->groupBy('produk.namabarang', 'gudang.lokasigudang')
        ->orderBy('produk.namabarang', 'desc')
        ->paginate(15);
        $produk = Produk::all(); // Ambil semua data produk
        $viewinventory = Inventory::with('produk')->orderBy('idbarang', 'desc')
        ->latest()
        ->paginate(15);
        return view('Gudang.inventory', compact('viewinventory', 'produk','stok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idgudang' => ['required', 'exists:gudang,gudang'],
            'tanggal' => ['required', 'date'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qtty' => ['required', 'numeric', 'min:0'],
        ]);

        $inventory = Inventory::create([
            'idgudang' => $request->idgudang,
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
