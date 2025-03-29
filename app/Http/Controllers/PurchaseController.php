<?php

namespace App\Http\Controllers;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\Gudang;
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
    public function create(Request $request)
{
    $gudang = Gudang::all();
    $supplier = Supplier::orderBy('namasupplier', 'asc')->get();
    $produk = Produk::all();

    $query = Pembelian::with('produk', 'supplier')
        ->orderBy(DB::raw('CASE WHEN status = "Pemesanan Baru" THEN 1 ELSE 2 END'))
        ->latest();

    // Apply filters if present
    if ($request->filled('tanggalorder')) {
        $query->whereDate('tanggalorder', $request->tanggalorder);
    }

    if ($request->filled('idsupplier')) {
        $query->where('idsupplier', $request->idsupplier);
    }

    if ($request->filled('idbarang')) {
        $query->where('idbarang', $request->idbarang);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $viewpurchaselist = $query->paginate(15)->withQueryString();

        return view('Purchase.datapembelian', compact('viewpurchaselist', 'supplier', 'produk', 'gudang'));
    }
    public function createpembelian(Request $request)
    {
        $gudang = Gudang::all();
        $supplier = Supplier::orderBy('namasupplier', 'asc')->get();
        $produk = Produk::all();
    
        $query = Pembelian::with('produk', 'supplier')
            ->orderBy(DB::raw('CASE WHEN status = "Pemesanan Baru" THEN 1 ELSE 2 END'))
            ->latest();
    
        // Apply filters if present
        if ($request->filled('tanggalorder')) {
            $query->whereDate('tanggalorder', $request->tanggalorder);
        }
    
        if ($request->filled('idsupplier')) {
            $query->where('idsupplier', $request->idsupplier);
        }
    
        if ($request->filled('idbarang')) {
            $query->where('idbarang', $request->idbarang);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $viewpurchaselist = $query->paginate(15)->withQueryString();
    
            return view('Purchase.purchasedata', compact('viewpurchaselist', 'supplier', 'produk', 'gudang'));
        }

        public function showAddPembelianForm()
        {
            $gudang = Gudang::all();
            $supplier = Supplier::orderBy('namasupplier', 'asc')->get();
            $produk = Produk::all();

        
            return view('Purchase.addpembelian', compact('gudang', 'supplier' ,'produk'));
        }
        public function showAddPembelianPadiForm()
        {
            $gudang = Gudang::all();
            $supplier = Supplier::orderBy('namasupplier', 'asc')->get();
            $produk = Produk::all();

        
            return view('Purchase.addpembelianpadi', compact('gudang', 'supplier' ,'produk'));
        }
    public function store(Request $request)
{
    $request->validate([
        'tanggalorder' => ['required', 'date'],
        'idsupplier' => ['required', 'exists:supplier,idsupplier'],
        'idgudang' => ['required', 'exists:gudang,idgudang'],
        'idbarang' => ['required', 'exists:produk,idbarang'],
        'qttyorder' => ['required', 'numeric', 'min:0'],
        
        'harga' => ['required', 'numeric', 'min:0'],
        'total' => ['required', 'numeric', 'min:0'],
    ]);

    try {
        // Proses menyimpan data pembelian
        $pembelian = Pembelian::create([
            'tanggalorder' => $request->tanggalorder,
            'idsupplier' => $request->idsupplier,
            'idbarang' => $request->idbarang,
            'idgudang' => $request->idgudang,
            'qttyorder' => $request->qttyorder,
            
            'harga' => $request->harga,
            'total' => $request->total,
        ]);

        // Redirect ke halaman form cetak faktur dengan ID pembelian (idorder)
        return redirect()->route('formcetakfaktur', ['id' => $pembelian->idorder]);
    } catch (\Exception $e) {
        // Handle error saat penyimpanan data
        return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data pembelian. Silakan coba lagi.']);
    }
}

public function storepadi(Request $request)
{
    $request->validate([
        'tanggalorder' => ['required', 'date'],
        'idsupplier' => ['required', 'exists:supplier,idsupplier'],
        'idgudang' => ['required', 'exists:gudang,idgudang'],
        'idbarang' => ['required', 'exists:produk,idbarang'],
        'qttyorder' => ['required', 'numeric', 'min:0'],
        'angin' => ['required', 'numeric', 'min:0'],
        'kongsi'  => ['required', 'numeric', 'min:0'],
        'mobil'  => ['required', 'numeric', 'min:0'],
        'harga' => ['required', 'numeric', 'min:0'],
        'total' => ['required', 'numeric', 'min:0'],
    ]);

    try {
        // Proses menyimpan data pembelian
        $pembelian = Pembelian::create([
            'tanggalorder' => $request->tanggalorder,
            'idsupplier' => $request->idsupplier,
            'idbarang' => $request->idbarang,
            'idgudang' => $request->idgudang,
            'qttyorder' => $request->qttyorder,
            'angin' => $request->angin,
            'kongsi' => $request->kongsi,
            'mobil' => $request->mobil,
            'harga' => $request->harga,
            'total' => $request->total,
        ]);

        // Redirect ke halaman form cetak faktur dengan ID pembelian (idorder)
        return redirect()->route('formcetakfaktur', ['id' => $pembelian->idorder]);
    } catch (\Exception $e) {
        // Handle error saat penyimpanan data
        return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data pembelian. Silakan coba lagi.']);
    }
}

    public function showCetakFaktur($id)
    {
        // Ambil data pembelian berdasarkan ID
        $pembelian = Pembelian::findOrFail($id);

        // Tampilkan view form cetak faktur dan kirim data pembelian ke view
        return view('Purchase.formcetakfaktur', compact('pembelian'));
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

        if ($purchase->status == 'dibayar') {
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

public function cetakFaktur($id)
{
    // Lakukan proses pencetakan faktur jika diperlukan

    // Redirect kembali ke halaman Sale.order
    return redirect()->route('viewpurchaselist');
}

public function highlightPembelianToday()
{
    $today = Carbon::today(); // Get today's date

    $viewpurchaselist = Pembelian::with('produk', 'supplier')
        ->whereDate('tanggalorder', $today) // Filter for today's date
        ->orderBy(DB::raw('CASE WHEN status = "Pemesanan Baru" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15); // Adjust pagination as needed

    return response()->json($viewpurchaselist);
}


}