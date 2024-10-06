<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'staff_id',
        'datetime',
        'note'
    ];

    public function release_details()
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
