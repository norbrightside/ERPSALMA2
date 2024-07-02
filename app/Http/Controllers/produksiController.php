<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
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
use Carbon\Carbon;
class ProduksiController extends Controller
{
    public function create(): View
    {
        $produk = Produk::all();
        $jadwalProduksi = Produksi::with('produk')->orderBy(DB::raw('CASE WHEN status = "Preproduksi" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15);
        return view('produksi.jadwalproduksi', compact('jadwalProduksi', 'produk'));
        
    }
    public function addjadwal(): View
    {
        $produk = Produk::all();
       
        return view('produksi.addjadwalproduksi' ,compact( 'produk'));
        
    }
    public function viewjadwal(): View
    {
        $produk = Produk::all();
        $jadwalProduksi = Produksi::with('produk')->orderBy(DB::raw('CASE WHEN status = "Preproduksi" THEN 1 ELSE 2 END'))
        ->latest()
        ->paginate(15);
        return view('produksi.viewjadwalproduksi', compact('jadwalProduksi', 'produk'));
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggalproduksi' => ['required', 'date'],
            'biayaproduksi' => ['required', 'numeric', 'min:0'],
            'idbarang' => ['required', 'exists:produk,idbarang'],
            'qttyproduksi' => ['required', 'numeric', 'min:0'],
        ]);

        $addjadwal = Produksi::create([
            'tanggalproduksi' => $request->tanggalproduksi,
            'biayaproduksi' => $request->biayaproduksi,
            'idbarang' => $request->idbarang,
            'qttyproduksi' => $request->qttyproduksi,
        ]);

        return redirect()->back()->with('success', 'Jadwal Produksi berhasil ditambahkan');
    }
    //
    public function updateStatus(Request $request, $id)
{
    $produksi = produksi::findOrFail($id);
    $produksi->status = $request->input('status');
    $produksi->updated_at = Carbon::now();
    $produksi->save();

    if ($produksi->status == 'produksi') {
        // Pilih random idgudang dari tabel gudang
        $randomGudang = DB::table('gudang')->inRandomOrder()->first();
        $randomGudang2 = DB::table('gudang')
        ->whereExists(function ($query) use ($produksi) {
            $query->select(DB::raw(1))
                  ->from('inventory')
                  ->whereRaw('inventory.idgudang = gudang.idgudang')
                  ->where('inventory.qtty', '>', 'produksi.qttyproduksi');
        })
        ->inRandomOrder()
        ->first();
        // Insert data untuk produk utama
        DB::table('inventory')->insert([
            'idgudang' => $randomGudang2->idgudang,
            'tanggal' => Carbon::now()->toDateString(),
            'idbarang' => $produksi->idbarang,
            'qtty' => $produksi->qttyproduksi,
            'status' => 'antrian keluar',
            'updated_at' => Carbon::now(),
        ]);

        // Calculate quantities for products 03 and 04
        $beras = $produksi->qttyproduksi * 0.55;
        $dedak = $beras * 0.336;
        $sekam = $beras * 0.48;

        // Insert data untuk produk 03
        DB::table('inventory')->insert([
            'idgudang' => $randomGudang->idgudang,
            'tanggal' => Carbon::now()->toDateString(),
            'idbarang' => '09',  // ID untuk produk 09
            'qtty' => $beras,
            'status' => 'antrian Masuk',
            'updated_at' => Carbon::now(),
        ]);

        // Insert data untuk produk 04 (dari 0.336 * qtty produk 03)
        DB::table('inventory')->insert([
            'idgudang' => $randomGudang->idgudang,
            'tanggal' => Carbon::now()->toDateString(),
            'idbarang' => '10',  // ID untuk produk 04
            'qtty' => $sekam,
            'status' => 'antrian masuk',
            'updated_at' => Carbon::now(),
        ]);

        // Insert data tambahan untuk produk 04 (dari 0.48 * qtty produk 03)
        DB::table('inventory')->insert([
            'idgudang' => $randomGudang->idgudang,
            'tanggal' => Carbon::now()->toDateString(),
            'idbarang' => '11',  // ID untuk produk 04
            'qtty' => $dedak,
            'status' => 'antrian masuk',
            'updated_at' => Carbon::now(),
        ]);
        
    }
    return redirect()->back()->with('success', 'Status berhasil diperbarui');
        
    }
}
