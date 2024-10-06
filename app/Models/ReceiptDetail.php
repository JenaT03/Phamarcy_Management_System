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
        'quantity',
        'original_price',
        'selling_price',
        'expiry'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function receipts()
    {
        return $this->belongsTo(Release::class);
    }
}
