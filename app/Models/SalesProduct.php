<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProduct extends Model
{
    use HasFactory;
    protected $table = 'sales_product';
    protected $fillable = [
        'user_id',
        'product_id',
        'jumlah',
        'total',
        'status_pesanan',
        'tanggal_penanaman',
        'alamat_pengiriman',
        'ongkir',
        'total_keseluruhan',
        'metode_pembayaran'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function perkembangan()
    {
        return $this->hasMany(Perkembangan::class, 'sales_product_id', 'id');
    }

    public function bukti_transfer()
    {
        return $this->hasOne(BuktiTransfer::class, 'sales_product_id', 'id');
    }
}
