<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelangganController extends Controller
{
    public function create(): View
    {
        return view('Pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapelanggan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:255'],
        ]);

        Pelanggan::create([
            'namapelanggan' => $request->namapelanggan,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ]);

        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan');
    }
}
