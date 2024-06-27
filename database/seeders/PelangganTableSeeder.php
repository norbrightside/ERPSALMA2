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
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            Pelanggan::create([
                'idpelanggan' => 'plg-12' . $index,
                'namapelanggan' => $faker->name,
                'alamat' => $faker->address,
                'kontak' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
