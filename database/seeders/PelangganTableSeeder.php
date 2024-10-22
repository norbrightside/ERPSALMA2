<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Pelanggan;

class PelangganTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));

        foreach (range(1, 100) as $index) {
            Pelanggan::create([
                'namapelanggan' => $faker->name,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
                
            ]);
        }
    }
}
