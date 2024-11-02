<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HandleImageTrait as TraitHandleImageTrait;

class Brand extends Model
{
    use HasFactory;
    use TraitHandleImageTrait;

    protected $fillable = [
        'name',
        'img',
        'country',
        'highlight',
    ];
}
