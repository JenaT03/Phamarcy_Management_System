<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'release_id',
        'product_id',
        'product_code',
        'quantity',
        'price',
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function releases()
    {
        return $this->belongsTo(Release::class);
    }

    public function checkQuantity($product, $quantity)
    {
        $sixMonthsLater = Carbon::now()->addMonths(6);
        $productDetails = $product->productdetails()
            ->where('expiry', '>', $sixMonthsLater)
            ->orderBy('expiry', 'asc')
            ->get();

        $totalAvailableQuantity = $productDetails->sum('quantity');
        if ($totalAvailableQuantity < $quantity) {
            return false;
        }
        return true;
    }
}
