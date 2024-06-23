<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PembelianTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('pembelian')->insert([
                'tanggalorder' => $faker->date(),
                'idsupplier' => $faker->numberBetween(1, 100),
                'idbarang' => $faker->numberBetween(1, 100),
                'qttyorder' => $faker->numberBetween(10, 5000),
                'hargapembelian' => $faker->numberBetween(1000000, 500000000),
            ]);
        }
    }
}
