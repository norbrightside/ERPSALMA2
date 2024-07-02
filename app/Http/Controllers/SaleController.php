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

    public function store(Request $request)
    {
        $request->validate([
            'tanggalpenjualan' => ['required', 'date'],
            'idpelanggan' => ['required', 'exists:pelanggan,idpelanggan'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'harga' => ['required', 'numeric', 'min:0'],
            'qttypenjualan' => ['required', 'numeric', 'min:0'],
        ]);

        // Hitung nilai transaksi berdasarkan harga dan qty
        $nilaitransaksi = $request->harga * $request->qttypenjualan;

        $penjualan = Penjualan::create([
            'tanggalpenjualan' => $request->tanggalpenjualan,
            'idpelanggan' => $request->idpelanggan,
            'idbarang' => $request->idbarang,
            'nilaitransaksi' => $nilaitransaksi,
            'qttypenjualan' => $request->qttypenjualan,
            'harga' => $request->harga,
            'status' => 'Order Baru', // Secara default set status 'Order Baru'
        ]);

        // Redirect ke halaman form cetak faktur dengan ID penjualan (nofak)
        return redirect()->route('formcetakfakturpenjualan', ['id' => $penjualan->nofak]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:Order Baru,Lunas,Pengiriman,Selesai'], // Sesuaikan dengan status yang diizinkan
        ]);

        $sale = Penjualan::findOrFail($id);
        $sale->status = strtolower($request->input('status')); // Ubah status menjadi lowercase
        $sale->updated_at = Carbon::now();
        $sale->save();

        if ($sale->status == 'Lunas') {
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

    public function showCetakFaktur($id)
    {
        $sale = Penjualan::findOrFail($id);

        return view('Sale.formcetakfakturpenjualan', compact('sale'));
    }

    public function cetakFaktur($id)
    {
        // Implementasikan logika cetak faktur jika dibutuhkan
        return redirect()->route('Sale.order');
    }
}
