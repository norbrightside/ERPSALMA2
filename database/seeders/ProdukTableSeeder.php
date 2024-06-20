<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('produk')->insert([
            ['namabarang' => 'Produk A', 'harga' => 10000],
            ['namabarang' => 'Produk B', 'harga' => 15000],
            ['namabarang' => 'Produk C', 'harga' => 20000],
        ]);
    }
}
