<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'idpelanggan';
    public $incrementing = false;
    protected $fillable = [
        'idpelanggan',
        'namapelanggan',
        'alamat',
        'kontak',
        'updated_at',
        'created_at',
        // tambahkan kolom lain yang relevan
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pelanggan) {
            $pelanggan->idpelanggan = 'plg-12' . (static::count() + 1); // Menggunakan jumlah data untuk menentukan ID berikutnya
        });
    }

    public function penjualan()
    {
        return $this->hasMany(penjualan::class, 'idpelanggan', 'idpelanggan'); // Relasi dengan model Pelanggan
    }
}
