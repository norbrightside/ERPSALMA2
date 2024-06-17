<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'idorder',	
        'tanggalorder',	
        'idsupplier',	
        'idbarang',
        'qttyorder',
        'hargapembelian',
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'idsupplier', 'idsupplier'); // Relasi dengan model Pelanggan
    }
}
