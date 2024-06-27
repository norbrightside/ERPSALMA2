<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProduksiTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $produkIds = DB::table('produk')->pluck('idbarang')->toArray();
        foreach (range(1, 100) as $index) {
            DB::table('produksi')->insert([
                'idproduksi' => 'prdksi-421'. $index,
                'tanggalproduksi' => $faker->date(),
                'biayaproduksi' => $faker->numberBetween(100000, 10000000),
                'idbarang' => $faker->randomElement($produkIds),
                'qttyproduksi' => $faker->numberBetween(1000, 10000), // Menggunakan nilai numerik
                'status' => $faker->randomElement(['Preproduksi', 'Produksi', 'Selesai']),
            ]);
        }
    }
}
