<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'idproduksi',
        'tanggalproduksi',
        'biayaproduksi',
        'idbarang',
        'qttyproduksi',
        'status',
        'updated_at',
        'created_at',
    ];

   
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
}
