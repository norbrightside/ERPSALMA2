<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
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
        return $this->hasMany(pembelian::class, 'idsupplier', 'idsupplier'); // Relasi dengan model Pelanggan
    }
}
