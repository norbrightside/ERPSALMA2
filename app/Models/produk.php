<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'idbarang',
        'namabarang',
        'harga',
        // tambahkan kolom lain yang relevan
    ];

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'idbarang', 'idbarang'); // Relasi dengan model Produksi
    }
}
