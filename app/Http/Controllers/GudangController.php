<?php

namespace App\Http\Controllers;
use App\Models\inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class GudangController extends Controller
{
    public function create(): View
    {
        $viewinventory = Inventory::with('produk')->get(); // Ambil semua jadwal dari database
        return view('Gudang.inventory', compact('viewinventory'));
        
    }
    //
}
