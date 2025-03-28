<?php

namespace App\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->category->orderBy('created_at', 'asc')->get(['id', 'name']));
    }
}
