<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenjualanTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('penjualan')->insert([
                'tanggalpenjualan' => $faker->date(),
                'idpelanggan' => $faker->numberBetween(1, 100),
                'idbarang' => $faker->numberBetween(1, 100),
                'nilaitransaksi' => $faker->numberBetween(1000000, 500000000),
                'qttypenjualan' => $faker->numberBetween(100, 5000),
                'status' => $faker->randomElement(['Order Baru', 'Lunas','Pengiriman', 'Selesai']),
            ]);
        }
    }
}
