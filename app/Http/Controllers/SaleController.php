<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function create(Request $request): View
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        $query = Penjualan::with('produk', 'pelanggan')
            ->orderBy(DB::raw('CASE WHEN status = "Order Baru" THEN 1 ELSE 2 END'))
            ->latest();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalpenjualan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalpenjualan', $request->tahun);
        }

        $viewsales = $query->paginate(15)->withQueryString();

        return view('Sale.order', compact('viewsales', 'pelanggan', 'produk'));
    }

   

    public function cetakFaktur($id)
    {
        return redirect()->route('Sale.order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalpenjualan' => ['required', 'date'],
            'idpelanggan' => ['required', 'exists:pelanggan,idpelanggan'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qttypenjualan' => ['required', 'numeric', 'min:0'],
        ]);

        $hargaProduk = Produk::findOrFail($request->idbarang)->harga;
        $nilaiTransaksi = $request->qttypenjualan * $hargaProduk;

        Penjualan::create([
            'tanggalpenjualan' => $request->tanggalpenjualan,
            'idpelanggan' => $request->idpelanggan,
            'idbarang' => $request->idbarang,
            'nilaitransaksi' => $nilaiTransaksi,
            'qttypenjualan' => $request->qttypenjualan,
        ]);

        return redirect()->back()->with([
            'success' => 'Penjualan berhasil ditambahkan',
            'nilaiTransaksi' => $nilaiTransaksi,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $sale = Penjualan::findOrFail($id);
        $sale->status = $request->input('status');
        $sale->updated_at = Carbon::now();
        $sale->save();

        if ($sale->status == 'lunas') {
            $randomGudang = DB::table('gudang')
                ->whereExists(function ($query) use ($sale) {
                    $query->select(DB::raw(1))
                        ->from('inventory')
                        ->whereRaw('inventory.idgudang = gudang.idgudang')
                        ->where('inventory.qtty', '>', 0);
                })
                ->inRandomOrder()
                ->first();

            DB::table('inventory')->insert([
                'idgudang' => $randomGudang->idgudang,
                'tanggal' => Carbon::now()->toDateString(),
                'idbarang' => $sale->idbarang,
                'qtty' => $sale->qttypenjualan,
                'updated_at' => Carbon::now(),
                'status' => 'antrian keluar',
            ]);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}