<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('inventory')->insert([
                'lokasigudang' => $faker->city,  // Menggunakan city untuk lokasi acak
                'tanggal' => $faker->date(),
                'idbarang' => $faker->numberBetween(1, 100),
                'qtty' => $faker->numberBetween(50, 500),
            ]);
        }
    }
}
