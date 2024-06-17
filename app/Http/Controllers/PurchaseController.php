<?php

namespace App\Http\Controllers;
use App\Models\pembelian;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function create(): View
    {
        $viewpurchaselist = pembelian::with('produk','pelanggan')->get(); // Ambil semua jadwal dari database
        return view('Purchase.datapembelian', compact('viewpurchaselist'));
        
    }
    //
}
