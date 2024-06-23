<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProduksiTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('produksi')->insert([
                'tanggalproduksi' => $faker->date(),
                'biayaproduksi' => $faker->numberBetween(100000, 10000000),
                'idbarang' => $faker->numberBetween(1, 100),
                'qttyproduksi' => $faker->numberBetween(50, 500),
                'status' => $faker->randomElement(['Preproduksi', 'Produksi', 'Selesai']),
            ]);
        }
    }
}
