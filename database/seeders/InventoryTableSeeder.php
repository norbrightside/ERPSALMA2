<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(config('app.faker_locale'));

        foreach (range(1, 100) as $index) {
            $produkIds = DB::table('produk')->pluck('idbarang')->toArray();
            // Ambil semua idgudang dari tabel gudang
            $gudangIds = DB::table('gudang')->pluck('idgudang')->toArray(); 
            DB::table('inventory')->insert([
                'idgudang' => $faker->randomElement($gudangIds),
                'tanggal' => $faker->dateTimeBetween('2020-01-01', '2024-12-31'),
                'status' => $faker->randomElement(['Antrian Masuk', 'Diterima', 'Antrian Keluar', 'Dikirim']),
                'idbarang' => $faker->randomElement($produkIds),
                'qtty' => $faker->numberBetween(50, 500),
            ]);
        }
    }
}
