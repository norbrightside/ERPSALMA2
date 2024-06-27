<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProdukTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));

        foreach (range(1, 5) as $index) {
            DB::table('produk')->insert([
                'namabarang' => $faker->word,
                'harga' => $faker->numberBetween(500000, 5000000),
            ]);
        }
    }
}
