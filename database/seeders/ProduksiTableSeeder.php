<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduksiTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('produksi')->insert([
            ['tanggalproduksi' => '2024-01-10', 'biayaproduksi' => 50000, 'idbarang' => 1, 'qttyproduksi' => 100, 'status' => 'selesai'],
            ['tanggalproduksi' => '2024-02-15', 'biayaproduksi' => 75000, 'idbarang' => 2, 'qttyproduksi' => 150, 'status' => 'selesai'],
        ]);
    }
}

