<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';

    protected $fillable = [
        'code',
        'name',
        'phone',
        'birth',
        'gender',
        'address'
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
