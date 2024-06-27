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
use Illuminate\Support\Facades\DB;
class PurchaseController extends Controller
{
    public function create(): View
    {
        $supplier = supplier::all();
        $produk = Produk::all();
        $viewpurchaselist = pembelian::with('produk','supplier')->orderBy(DB::raw('CASE WHEN status = "Pemesanan Baru" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15);
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
