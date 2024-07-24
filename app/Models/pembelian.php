<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey ='idorder';
    protected $fillable = [
        'idorder',	
        'tanggalorder',	
        'idsupplier',	
        'idbarang',
        'idgudang',
        'angin',
        'kongsi',
        'mobil',
        'qttyorder',
        'status',
        'harga',
        'total',
        'created_at',
        'updated_at',
    ];

    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'idsupplier', 'idsupplier'); // Relasi dengan model Pelanggan
    }
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'idgudang', 'idgudang'); // Relasi dengan model Produk
    }
}
