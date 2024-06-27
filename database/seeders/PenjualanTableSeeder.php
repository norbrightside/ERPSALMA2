<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenjualanTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $produkIds = DB::table('produk')->pluck('idbarang')->toArray();
            $pelangganid = DB::table('pelanggan')->pluck('idpelanggan')->toArray();

            DB::table('penjualan')->insert([
                'nofak' => 'slmaa-121' . $index,
                'tanggalpenjualan' => $faker->date(),
                'idpelanggan' => $faker->randomElement($pelangganid),
                'idbarang' => $faker->randomElement($produkIds),
                'nilaitransaksi' => $faker->numberBetween(1000000, 500000000),
                'qttypenjualan' => $faker->numberBetween(100, 5000),
                'status' => $faker->randomElement(['Order Baru', 'Lunas','Pengiriman', 'Selesai']),
            ]);
        }
    }
}
