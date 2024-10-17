<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'product_id',
        'product_code',
        'quantity',
        'original_price',
        'selling_price',
        'expiry'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }


    public function productdetails()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
