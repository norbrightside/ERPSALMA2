<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
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
        'updated_at',
        'created_at',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan'); // Relasi dengan model Pelanggan
    }
}
