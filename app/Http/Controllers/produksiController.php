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

        if ($produksi->status == 'Selesai') {
            // Pilih random idgudang dari tabel gudang
            $randomGudang = DB::table('gudang')->inRandomOrder()->first();

            // Tambahkan data baru ke tabel inventory
            DB::table('inventory')->insert([
                'idgudang' => $randomGudang->idgudang,
                'tanggal' => Carbon::now()->toDateString(),
                'idbarang' => $produksi->idbarang,
                'qtty' => $produksi->qttyproduksi,
                'updated_at' => Carbon::now(),

            ]);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
