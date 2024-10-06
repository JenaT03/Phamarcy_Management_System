<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'staff_id',
        'supplier_id'
    ];

    public function receipt_details()
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
