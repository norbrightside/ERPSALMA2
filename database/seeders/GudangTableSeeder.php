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
        $faker = Faker::create(config('app.faker_locale'));
        foreach (range(1, 2) as $index) {
            DB::table('gudang')->insert([
                'lokasigudang' => $faker->city,
            ]);
        //
    }
}
}