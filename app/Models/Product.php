<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'kode',
        'nama',
        'detail',
        'harga',
        'stok',
        'image',
        'status',
    ];

    public function SalesProduct()
    {
        return $this->hasMany(SalesProduct::class, 'product_id', 'id');
    }
}
