<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProdukTableSeeder::class,
            SupplierTableSeeder::class,
            PembelianTableSeeder::class,
            ProduksiTableSeeder::class,
            PelangganTableSeeder::class,
            PenjualanTableSeeder::class,
            InventoryTableSeeder::class,
        ]);
       
        User::factory()->create([
            'name' => 'Muhammad Rizki',
            'email' => 'mrizki842@gmail.com',
            'password' =>'Rizki5665',
        ]);
    }
}
