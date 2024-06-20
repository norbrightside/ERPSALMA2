<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pelanggan')->insert([
            ['namapelanggan' => 'Pelanggan A', 'alamat' => 'Alamat A', 'kontak' => 12345],
            ['namapelanggan' => 'Pelanggan B', 'alamat' => 'Alamat B', 'kontak' => 67890],
        ]);
    }
}
