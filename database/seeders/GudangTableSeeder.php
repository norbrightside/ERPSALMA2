<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class GudangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 3) as $index) {
            DB::table('gudang')->insert([
                'idgudang' => 'prdksi-421'. $index,
                'lokasigudang' => $faker->city,
                'status' => $faker->randomElement(['Dalam Pengiriman', 'Diterima']),
            ]);
        //
    }
}
}