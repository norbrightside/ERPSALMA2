<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function report(Request $request): View
    {
        $query = Penjualan::with('produk', 'pelanggan')
            ->orderBy(DB::raw('CASE WHEN status = "Lunas" THEN 1 ELSE 2 END'))
            ->latest();


        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalpenjualan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalpenjualan', $request->tahun);
        }

        $laporan = $query->paginate(15)->withQueryString();

        return view('laporan.laporan', compact('laporan'));
    }

    public function reportprintsale(Request $request): View
    {
        $query = Penjualan::with('produk', 'pelanggan')
            ->orderBy(DB::raw('CASE WHEN status = "Lunas" THEN 1 ELSE 2 END'))
            ->latest();


        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalpenjualan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalpenjualan', $request->tahun);
        }

        // Retrieve all records
    $laporan = $query->get();

    // Get the current query string parameters
    $queryString = $request->query();

        return view('laporan.partials.laporanpenjualanprint', compact('laporan', 'queryString'));
    }
}
