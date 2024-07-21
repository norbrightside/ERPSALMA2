<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
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

   

        public function inventory()
    {
        return $this->hasMany(Inventory::class, 'idgudang', 'idgudang');
    }

}
