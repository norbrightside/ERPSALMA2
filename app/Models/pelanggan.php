<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'idpelanggan',
        'namapelanggan',
        'alamat',
        'kontak',
        // tambahkan kolom lain yang relevan
    ];

    public function penjualan()
    {
        return $this->hasMany(penjualan::class, 'idpelanggan', 'idpelanggan'); // Relasi dengan model Pelanggan
    }
}
