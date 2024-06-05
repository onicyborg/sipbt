<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    use HasFactory;
    protected $table = 'perkembangan';
    protected $fillable = [
        'sales_product_id',
        'image',
        'tinggi',
        'keterangan'
    ];

    public function sales_product()
    {
        return $this->belongsTo(SalesProduct::class, 'sales_product_id', 'id');
    }
}
