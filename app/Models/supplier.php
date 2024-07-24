<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey ='idsupplier';
    protected $fillable = [
        'idsupplier',
        'namasupplier',
        'alamat',
        'kontak',
        // tambahkan kolom lain yang relevan
    ];

   
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'idsupplier', 'idsupplier'); // Relasi dengan model Pelanggan
    }
}
