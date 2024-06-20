<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembelianTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembelian')->insert([
            ['tanggalorder' => '2024-01-01', 'idsupplier' => 1, 'idbarang' => 1, 'qttyorder' => 10, 'hargapembelian' => 100000],
            ['tanggalorder' => '2024-02-01', 'idsupplier' => 2, 'idbarang' => 2, 'qttyorder' => 20, 'hargapembelian' => 300000],
        ]);
    }
}
