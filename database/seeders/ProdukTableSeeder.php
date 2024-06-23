<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProdukTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('produk')->insert([
                'namabarang' => $faker->word,
                'harga' => $faker->numberBetween(500000, 5000000),
            ]);
        }
    }
}
