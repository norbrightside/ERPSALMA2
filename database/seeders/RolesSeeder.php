<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data roles yang ingin dimasukkan
        $Roles = [
            ['idrole' => 1, 'namarole' => 'Admin'],
            ['idrole' => 2, 'namarole' => 'Sale'],
            ['idrole' => 3, 'namarole' => 'Purchase'],
            ['idrole' => 4, 'namarole' => 'Gudang'],
            ['idrole' => 5, 'namarole' => 'Produksi'],
        ];

        // Masukkan data roles ke dalam database
        Roles::insert($Roles);
    }
}
