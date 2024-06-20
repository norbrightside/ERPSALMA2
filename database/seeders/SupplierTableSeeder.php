<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier')->insert([
            ['namasupplier' => 'Supplier A', 'alamat' => 'Alamat A', 'kontak' => 12345],
            ['namasupplier' => 'Supplier B', 'alamat' => 'Alamat B', 'kontak' => 67890],
        ]);
    }
}
