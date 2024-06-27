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
        'updated_at',
        'created_at',
        // tambahkan kolom lain yang relevan
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            $produk->idbarang = 'Prdk-111' . (static::count() + 1); // Menggunakan jumlah data untuk menentukan ID berikutnya
        });
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'idbarang', 'idbarang'); // Relasi dengan model Produksi
    }
    public function pembelian()
    {
        return $this->hasMany(Produksi::class, 'idbarang', 'idbarang'); // Relasi dengan model Produksi
    }
    public function penjualan()
    {
        return $this->hasMany(Produksi::class, 'idbarang', 'idbarang'); // Relasi dengan model Produksi
    }
}
