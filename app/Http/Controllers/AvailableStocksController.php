<?php
// app/Http/Controllers/AvailableStocksController.php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AvailableStocksController extends Controller
{
    public function availableStocks()
    {
        $availableStocks = Inventory::select('idbarang', 'lokasigudang', DB::raw('SUM(qtty) as total_qty'))
            ->groupBy('idbarang', 'lokasigudang')
            ->get();

        return view('Gudang.partials.list-stokavailable', compact('availableStocks'));
    }
}
