<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'idgudang',
        'lokasigudang',
        'tanggal',
        'idbarang',
        'qtty',	
        'status',
        'updated_at',
        'created_at',
    ];
   

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idbarang', 'idbarang'); // Relasi dengan model Produk
    }
    public function gudang()
    {
        return $this->belongsTo(gudang::class,'idgudang','idgudang');
    }
}
