<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PembelianTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));
        $produkIds = range(1, 8);
        $gudangIds = DB::table('gudang')->pluck('idgudang')->toArray();
        $supplierIds = DB::table('supplier')->pluck('idsupplier')->toArray();
        foreach (range(1, 41) as $index) {
            DB::table('pembelian')->insert([
                'tanggalorder' => $faker->dateTimeBetween('2024-01-01', '2024-07-31'),
                'idsupplier' => $faker->randomElement($supplierIds),
                'idgudang' => $faker->randomElement($gudangIds),
                'idbarang' => $faker->randomElement($produkIds),
                'status' => $faker->randomElement(['Pemesanan Baru']),
                'qttyorder' => $qttyOrder = $faker->numberBetween(700, 5000),
                'harga' => $harga = $faker->numberBetween(7200, 7500),
                'total' => $qttyOrder * $harga,
            ]);
        }
    }
}
