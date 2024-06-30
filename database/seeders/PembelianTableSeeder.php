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
        $produkIds = DB::table('produk')->pluck('idbarang')->toArray();
        $gudangIds = DB::table('gudang')->pluck('idgudang')->toArray();
        $supplierIds = DB::table('supplier')->pluck('idsupplier')->toArray();
        foreach (range(1, 100) as $index) {
            DB::table('pembelian')->insert([
                'tanggalorder' => $faker->dateTimeBetween('2020-01-01', '2024-12-31'),
                'idsupplier' => $faker->randomElement($supplierIds),
                'idgudang' => $faker->randomElement($gudangIds),
                'idbarang' => $faker->randomElement($produkIds),
                'status' => $faker->randomElement(['Pemesanan Baru','Dibayar', 'Diterima']),
                'qttyorder' => $faker->numberBetween(10, 5000),
                'hargapembelian' => $faker->numberBetween(1000000, 500000000),
            ]);
        }
    }
}
