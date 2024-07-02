<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProdukTableSeeder extends Seeder
{
    public function run()
    {
        $staticValues = ['Padi Pm', 'Junjuang', 'Anak Daro', 'Pb', 'Kuriak', 'Kuniang', 'RK', 'Bujang Marantau', 'Beras', 'Sekam', 'Dedak', 'Solar'];
        $faker = Faker::create(config('app.faker_locale'));

        foreach ($staticValues as $value) {
            DB::table('produk')->insert([
                'namabarang' => $value,
            ]);
        }
    }
    
}
