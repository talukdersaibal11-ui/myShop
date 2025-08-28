<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function __construct(protected Category $model){}

    public function store($request)
    {
        $category = new $this->model();

        $category->name = Str::title($request->name);

        $category->save();

        return $category;
    }
}
