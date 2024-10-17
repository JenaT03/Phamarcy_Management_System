<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'staff_id',
        'datetime',
        'total',
        'note'
    ];

    public function release_details()
    {
        return $this->hasMany(ReleaseDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function reduceProductQuantity($product, $quantity)
    {
        $sixMonthsLater = Carbon::now()->addMonths(6);
        $productDetails = $product->productdetails()
            ->where('expiry', '>', $sixMonthsLater)
            ->orderBy('expiry', 'asc')
            ->get();

        foreach ($productDetails as $productDetail) {
            if ($quantity <= 0) {
                break; // Đã đủ số lượng cần thiết
            }

            if ($productDetail->quantity >= $quantity) {
                // Trừ số lượng trực tiếp từ ProductDetail
                $productDetail->quantity -= $quantity;
                $productDetail->save();
                $quantity = 0; // Đã lấy đủ
            } else {
                // Trừ hết số lượng trong ProductDetail này và tiếp tục với ProductDetail tiếp theo
                $quantity -= $productDetail->quantity;
                $productDetail->quantity = 0;
                $productDetail->save();
            }
        }

        return true;
    }
}
