<?php

namespace App\Models;

use App\Traits\HandleImageTrait as TraitHandleImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HandleImageTrait;

class Product extends Model
{
    use HasFactory;
    use TraitHandleImageTrait;
    protected $fillable = [
        'code',
        'name',
        'description',
        'ingredient',
        'intruction',
        'img',
        'brand_id',
        'unit',
    ];

    public function receipts()
    {
        return $this->hasMany(ReceiptDetail::class);
    }

    public function releases()
    {
        return $this->hasMany(ReceiptDetail::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function productdetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function assignCategory($categoryIds)
    {
        return $this->categories()->sync($categoryIds); //sync() cập nhật quan hệ nhiều nhiều trong bảng category_product
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getBy($data, $categoryId)
    {
        return $this->whereHas('categories', fn($q) => $q->where('category_id', $categoryId))->paginate(12);
    }
}
