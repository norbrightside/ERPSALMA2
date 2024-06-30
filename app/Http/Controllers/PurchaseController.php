<?php

namespace App\Http\Controllers;
use App\Models\pembelian;
use App\Models\supplier;
use App\Models\Produk;
use App\Models\gudang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PurchaseController extends Controller
{
    public function create(): View
    {

        $gudang = gudang::all();
        $supplier = supplier::all();
        $produk = Produk::all();
        $viewpurchaselist = pembelian::with('produk','supplier')->orderBy(DB::raw('CASE WHEN status = "Pemesanan Baru" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15);
        return view('Purchase.datapembelian', compact('viewpurchaselist','supplier','produk', 'gudang'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalorder' => ['required', 'date'],
            'idsupplier' => ['required', 'exists:supplier,idsupplier'],
            'idgudang' => ['required', 'exists:gudang,idgudang'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qttyorder' => ['required', 'numeric', 'min:0'],
            'hargapembelian' => ['required', 'numeric', 'min:0'],
        ]);
        $totalBayar = $request->qttyorder * $request->hargapembelian;
        pembelian::create([
            'tanggalorder' => $request->tanggalorder,
            'idsupplier' => $request->idsupplier,
            'idbarang' => $request->idbarang,
            'idgudang' => $request->idgudang,
            'qttyorder' => $request->qttyorder,
            'hargapembelian' => $request->hargapembelian,
            'totalbayar' => $totalBayar,
            
        ]);
        
        return redirect()->route('viewpurchaselist');
        }
    //
    public function showBelipadiForm()
    {
        $supplier = Supplier::all();
        $gudang = Gudang::all();
        $produk = Produk::all();

        return view('Purchase.belipadi', compact('supplier', 'gudang', 'produk'));
    }
    public function updateStatus(Request $request, $id)
    {
        $purchase = pembelian::findOrFail($id);
        $purchase->status = $request->input('status');
        $purchase->updated_at = Carbon::now();
        $purchase->save();

        if ($purchase->status == 'dibayar' || $purchase->status == 'diterima') {
            // Pilih random idgudang dari tabel gudang
           
            // Tambahkan data baru ke tabel inventory
            DB::table('inventory')->insert([
                'idgudang' => $purchase->idgudang,
                'tanggal' => Carbon::now()->toDateString(),
                'idbarang' => $purchase->idbarang,
                'qtty' => $purchase->qttyorder,
                'updated_at' => Carbon::now(),

            ]);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
