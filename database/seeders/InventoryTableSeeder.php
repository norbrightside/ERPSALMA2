<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('inventory')->insert([
            ['lokasigudang' => 'Gudang A', 'tanggal' => '2024-01-01', 'idbarang' => 1, 'qtty' => 100 ],
            ['lokasigudang' => 'Gudang B', 'tanggal' => '2024-02-01', 'idbarang' => 2, 'qtty' => 200],
        ]);
    }
}
