<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransfer extends Model
{
    use HasFactory;

    protected $table = 'bukti_transfer';
    protected $fillable = [
        'image',
        'status',
        'sales_product_id'
    ];

    public function sales_product()
    {
        return $this->belongsTo(SalesProduct::class, 'sales_product_id', 'id');
    }
}
