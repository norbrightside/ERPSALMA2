<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('supplier')->insert([
                'namasupplier' => $faker->name,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
            ]);
        }
    }
}
