<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    
    protected $fillable = [
        'idsupplier',
        'namasupplier',
        'alamat',
        'kontak',
        // tambahkan kolom lain yang relevan
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            $supplier->idsupplier = 'splly-11' . (static::count() + 1); // Menggunakan jumlah data untuk menentukan ID berikutnya
        });
    }
    public function pembelian()
    {
        return $this->hasMany(pembelian::class, 'idsupplier', 'idsupplier'); // Relasi dengan model Pelanggan
    }
}
