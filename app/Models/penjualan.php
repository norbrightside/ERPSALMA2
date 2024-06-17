<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nofak',
        'tanggalpenjualan',
        'idpelanggan',
        'idbarang',
        'nilaitransaksi',
        'qttypenjualan',
        'status',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class, 'idpelanggan', 'idpelanggan'); // Relasi dengan model Pelanggan
    }
}
