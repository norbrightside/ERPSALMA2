<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('penjualan')->insert([
            ['tanggalpenjualan' => '2024-01-20', 'idpelanggan' => 1, 'idbarang' => 1, 'nilaitransaksi' => 100000, 'qttypenjualan' => 10, 'status' => 'selesai'],
            ['tanggalpenjualan' => '2024-02-25', 'idpelanggan' => 2, 'idbarang' => 2, 'nilaitransaksi' => 300000, 'qttypenjualan' => 20, 'status' => 'selesai'],
        ]);
    }
}
