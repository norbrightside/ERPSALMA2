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
    $viewsales = Penjualan::with('produk', 'pelanggan')
        ->orderBy(DB::raw('CASE WHEN status = "Order Baru" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15);

    // Ambil data penjualan berdasarkan bulan yang dipilih
    $bulan = $request->input('bulan');
    $laporan = Penjualan::query();

    if ($bulan) {
        $laporan->whereMonth('tanggalpenjualan', $bulan);
    }

    $laporan = $laporan->with('produk')
        ->where('status', 'Lunas')
        ->orderBy('tanggalpenjualan', 'desc')
        ->paginate(15);

    return view('Sale.order', compact('viewsales', 'pelanggan', 'produk', 'laporan'));
}
public function cetakFaktur($id)
{
    // Lakukan proses pencetakan faktur jika diperlukan

    // Redirect kembali ke halaman Sale.order
    return redirect()->route('Sale.order');
}


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggalpenjualan' => ['required', 'date'],
            'idpelanggan' => ['required', 'exists:pelanggan,idpelanggan'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qttypenjualan' => ['required', 'numeric', 'min:0'],
        ]);

        // Ambil harga produk dari database berdasarkan idbarang
        $hargaProduk = Produk::findOrFail($request->idbarang)->harga;

        // Hitung nilai transaksi
        $nilaiTransaksi = $request->qttypenjualan * $hargaProduk;

        // Simpan data penjualan ke dalam database
        Penjualan::create([
            'tanggalpenjualan' => $request->tanggalpenjualan,
            'idpelanggan' => $request->idpelanggan,
            'idbarang' => $request->idbarang,
            'nilaitransaksi' => $nilaiTransaksi,
            'qttypenjualan' => $request->qttypenjualan,
        ]);

        // Redirect dengan pesan sukses dan data yang diperlukan
        return redirect()->back()->with([
            'success' => 'Penjualan berhasil ditambahkan',
            'nilaiTransaksi' => $nilaiTransaksi, // Melewatkan nilai transaksi ke view jika diperlukan
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $sale = penjualan::findOrFail($id);
        $sale->status = $request->input('status');
        $sale->updated_at = Carbon::now();
        $sale->save();

        if ($sale->status == 'lunas') {
            // Pilih random idgudang dari tabel gudang
            $randomGudang = DB::table('gudang')
            ->whereExists(function ($query) use ($sale) {
                $query->select(DB::raw(1))
                      ->from('inventory')
                      ->whereRaw('inventory.idgudang = gudang.idgudang')
                      ->where('inventory.qtty', '>', 0);
                    })
                    ->inRandomOrder()
                    ->first();   
            // Tambahkan data baru ke tabel inventory
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
