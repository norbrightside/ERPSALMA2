<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function report(Request $request): View
    {
        $query = Penjualan::with('produk', 'pelanggan')
             ->where('status','Lunas')
            ->latest();


        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalpenjualan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalpenjualan', $request->tahun);
        }

        // Paginate the results, displaying 15 records per page
$laporan = $query->paginate(15);

// Manually append the query string parameters to the pagination links
$laporan->appends($request->all());

        return view('laporan.laporan', compact('laporan'));
    }

    public function reportproduksi(Request $request): View
    {
        $query = Produksi::with('produk')
             ->where('status','produksi', 'selesai')
            ->latest();


        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalproduksi', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalproduksi', $request->tahun);
        }

        // Paginate the results, displaying 15 records per page
$laporanproduksi = $query->paginate(15);

// Manually append the query string parameters to the pagination links
$laporanproduksi->appends($request->all());

        return view('laporan.laporanproduksi', compact('laporanproduksi'));
    }

    public function reportprintproduksi(Request $request): View
    {
        $query = produksi::with('produk', )
        ->where('status','Produksi', 'Selesai')
            ->latest();


        if ($request->filled('bulan')) {
            $query->whereMonth('tanggalproduksi', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggalproduksi', $request->tahun);
        }

        // Retrieve all records
    $laporanproduksi = $query->get();

    // Get the current query string parameters
    $queryString = $request->query();

        return view('laporan.partials.laporanproduksiprint', compact('laporanproduksi', 'queryString'));
    }
    public function reportprintsale(Request $request): View
{
    $query = Penjualan::with('produk', 'pelanggan')
        ->where('status', 'Lunas')
        ->latest();

    if ($request->filled('bulan')) {
        $query->whereMonth('tanggalpenjualan', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('tanggalpenjualan', $request->tahun);
    }

    // Retrieve all records based on filters
    $laporan = $query->get();

    // Get the current query string parameters
    $queryString = $request->query();

    return view('laporan.partials.laporanpenjualanprint', compact('laporan', 'queryString'));
}



}
