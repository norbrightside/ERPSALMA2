<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'idgudang',
        'lokasigudang',
        'tanggal',
        'idbarang',
        'qtty',	
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
}
