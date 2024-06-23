<?php

namespace App\Http\Controllers;
use App\Models\pembelian;
use App\Models\supplier;
use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function create(): View
    {
        $supplier = supplier::all();
        $produk = Produk::all();
        $viewpurchaselist = pembelian::with('produk','supplier')->paginate(15); // Ambil semua jadwal dari database
        return view('Purchase.datapembelian', compact('viewpurchaselist','supplier','produk'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalorder' => ['required', 'date'],
            'idsupplier' => ['required', 'exists:supplier,idsupplier'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qttyorder' => ['required', 'numeric', 'min:0'],
            'hargapembelian' => ['required', 'numeric', 'min:0'],
        ]);

        pembelian::create([
            'tanggalorder' => $request->tanggalorder,
            'idsupplier' => $request->idsupplier,
            'idbarang' => $request->idbarang,
            'qttyorder' => $request->qttyorder,
            'hargapembelian' => $request->hargapembelian,
        ]);

        return redirect()->back()->with('success', 'Penjualan berhasil ditambahkan');
        }
    //
}
