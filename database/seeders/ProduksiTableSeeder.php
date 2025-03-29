<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProduksiTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));
        $produkIds = range(1, 8); // Only use idProduk 1 to 8
        foreach (range(1, 15) as $index) {
            DB::table('produksi')->insert([
                'tanggalproduksi' => $faker->dateTimeBetween('2024-01-01', '2024-07-31'),
                'idbarang' => $faker->randomElement($produkIds),
                'qttyproduksi' => $qtty = $faker->numberBetween(1000, 2000), // Using numerical value
                'biayaproduksi' => $qtty * 352,
                'status' => $faker->randomElement(['Preproduksi']),
            ]);
        }
    }
}
