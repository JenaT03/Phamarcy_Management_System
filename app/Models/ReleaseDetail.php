<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'release_id',
        'product_id',
        'quantity',
        'price',
        'note'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function releases()
    {
        return $this->belongsTo(Release::class);
    }
}
