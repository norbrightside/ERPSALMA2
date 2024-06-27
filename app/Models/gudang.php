<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'idgudang';
    public $incrementing = false;
    protected $fillable = [
        'idgudang',
        'lokasigudang',
        'status',
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

        public function inventory()
    {
        return $this->hasMany(Inventory::class, 'idgudang', 'idgudang');
    }

}
