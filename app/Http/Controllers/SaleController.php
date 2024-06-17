<?php

namespace App\Http\Controllers;
use App\Models\penjualan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function create(): View
    {
        $viewsales = penjualan::with('produk','pelanggan')->get(); // Ambil semua jadwal dari database
        return view('Sale.order', compact('viewsales'));
        
    }
    //
    
}
