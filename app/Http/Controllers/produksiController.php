<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
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
        $jadwalProduksi = Produksi::with('produk')->get(); // Ambil semua jadwal dari database
        return view('produksi.jadwalproduksi', compact('jadwalProduksi'));
        
    }
    public function store(Request $request)
{
    // Validasi data yang dikirim dari form
    $validatedData = $request->validate([
        'tanggalproduksi' => 'required|date',
        'biayaproduksi' => 'required|numeric',
        'idbarang' => 'required|exists:barang,id',
        'qttyproduksi' => 'required|integer|min:1',
        'status' => 'required|in:Pending,Selesai,Batal',
    ]);

    // Simpan data jadwal produksi ke dalam database
    Produksi::create($validatedData);

    // Redirect ke halaman lain dengan pesan sukses atau yang lainnya
    return redirect()->route('jadwal-produksi.index')->with('success', 'Jadwal produksi berhasil ditambahkan!');
}

    //
}
