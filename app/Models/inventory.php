<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'idgudang';
    public $incrementing = false;
    protected $fillable = [
        'idgudang',
        'lokasigudang',
        'tanggal',
        'idbarang',
        'qtty',	
        'updated_at',
        'created_at',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($Inventory) {
            $Inventory->idgudang = 'Pdg-11' . (static::count() + 1); // Menggunakan jumlah data untuk menentukan ID berikutnya
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
}
