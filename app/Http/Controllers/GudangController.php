<?php

namespace App\Http\Controllers;
use App\Models\inventory;
use app\models\Produk;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateproduk;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
class GudangController extends Controller
{
    public function create(): View
    {
        $viewinventory = Inventory::with('produk')->get(); // Ambil semua jadwal dari database
        return view('Gudang.inventory', compact('viewinventory'));
        
    }
    //

    public function edit($id)
{
    $produk = Produk::findOrFail($id);
    return view('barang.edit', compact('produk'));
}

    public function update(UpdateProduk $request, $id): RedirectResponse
{
    // Ambil produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // Perbarui atribut produk
    $produk->namabarang = $request->input('namabarang');
    $produk->harga = $request->input('harga');

    // Simpan perubahan
    $produk->save();

    // Redirect ke halaman edit dengan pesan status
    return redirect()->route('Gudang.barang.edit', $id)->with('status', 'Barang updated');
}
}
