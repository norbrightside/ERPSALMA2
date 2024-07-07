<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GudangController extends Controller
{
 
    public function create(Request $request): View
    {
        $stok = DB::table('gudang')
            ->join('inventory', 'gudang.idgudang', '=', 'inventory.idgudang')
            ->join('produk', 'inventory.idbarang', '=', 'produk.idbarang')
            ->select('gudang.lokasigudang', 'produk.namabarang',
             DB::raw('SUM(CASE WHEN inventory.status = "diterima" THEN inventory.qtty ELSE 0 END) - 
                      SUM(CASE WHEN inventory.status = "dikirim" THEN inventory.qtty ELSE 0 END) as total_qtty'))->groupBy('produk.namabarang', 'gudang.lokasigudang')
            ->orderBy('gudang.lokasigudang', 'asc')
            ->get();
    
        $produk = Produk::all(); // Ambil semua data produk
    
        $query = Inventory::with('produk')->orderBy('updated_at', 'desc');
    
        // Apply filters if present
        if ($request->filled('lokasigudang')) {
            $query->whereHas('gudang', function ($query) use ($request) {
                $query->where('lokasigudang', $request->lokasigudang);
            });
        }
    
        if ($request->filled('namabarang')) {
            $query->whereHas('produk', function ($query) use ($request) {
                $query->where('namabarang', $request->namabarang);
            });
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $viewinventory = $query->paginate(15)->withQueryString();
    
        return view('Gudang.inventory', compact('viewinventory', 'produk', 'stok'));
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
           
        ]);

        Produk::create([
            'namabarang' => $request->namabarang,
           
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }
    public function updateStatus(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->status = $request->input('status');
        $inventory->updated_at = Carbon::now();
        $inventory->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

}
