<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HandleImageTrait as TraitHandleImageTrait;

class News extends Model
{
    use HasFactory;
    use TraitHandleImageTrait;
    protected $fillable = [
        'title',
        'img',
        'author',
        'abstract',
        'content',
        'highlight',
        'staff_id',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
