<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'birth',
        'gender'
    ];

    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function releases()
    {
        return $this->hasMany(Release::class);
    }
}
