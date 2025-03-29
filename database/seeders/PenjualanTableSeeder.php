<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenjualanTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));
        foreach (range(1, 15) as $index) {
            $produkIds = [9];
            $pelangganid = DB::table('pelanggan')->pluck('idpelanggan')->toArray();

            DB::table('penjualan')->insert([
                'tanggalpenjualan' => $faker->dateTimeBetween('2024-05-01', '2024-08-05'),
                'idpelanggan' => $faker->randomElement($pelangganid),
                'idbarang' => $faker->randomElement($produkIds),
                'harga' => $harga = $faker->numberBetween(120000,150000),
                'qttypenjualan' => $qttypenjualan = $faker->numberBetween(100, 5000),
                'status' => $faker->randomElement(['Order Baru']),
                'nilaitransaksi' => $harga * $qttypenjualan,
            ]);
        }
    }
}
