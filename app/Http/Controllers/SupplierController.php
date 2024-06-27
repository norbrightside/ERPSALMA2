<?php

namespace App\Http\Controllers;
use App\Models\supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function create(): View
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namasupplier' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:255'],
        ]);

        supplier::create([
            'namasupplier' => $request->namapelanggan,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ]);

        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan');
    }
}
