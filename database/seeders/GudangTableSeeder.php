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
        $staticValues = ['Gudang Lt 2', 'Gudang Lantai 1'];
     
        $faker = Faker::create(config('app.faker_locale'));
        foreach ($staticValues as $value) {
            DB::table('gudang')->insert([
                'lokasigudang' => $value,
            ]);
        //
    }
}
}