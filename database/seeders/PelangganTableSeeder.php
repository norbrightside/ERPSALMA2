<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PelangganTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('pelanggan')->insert([
                'namapelanggan' => $faker->name,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
            ]);
        }
    }
}
