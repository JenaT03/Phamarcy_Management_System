<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'receipt_detail_id',
        'price',
        'quantity',
        'expiry',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
