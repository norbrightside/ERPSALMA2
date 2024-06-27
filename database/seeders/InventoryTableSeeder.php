<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $produkIds = DB::table('produk')->pluck('idbarang')->toArray();
            // Ambil semua idgudang dari tabel gudang
            $gudangIds = DB::table('gudang')->pluck('idgudang')->toArray(); 
            DB::table('inventory')->insert([
                'idgudang' => $faker->randomElement($gudangIds),
                'tanggal' => $faker->date(),
                'idbarang' => $faker->randomElement($produkIds),
                'qtty' => $faker->numberBetween(50, 500),
            ]);
        }
    }
}
