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
class ProduksiController extends Controller
{
    public function create(): View
    {
        $produk = Produk::all();
        $jadwalProduksi = Produksi::with('produk')->get(); // Ambil semua jadwal dari database
        return view('produksi.jadwalproduksi', compact('jadwalProduksi','produk'));
        
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
}
