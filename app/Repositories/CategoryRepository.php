<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Exceptions\CustomException;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository
{
    public function __construct(protected Category $model){}

    public function index($request)
    {
        $paginateSize = $request->input('paginate_size', null);
        $paginateSize = Helper::checkPaginateSize($request);
        $searchKey    = $request->input('search_key', null);

        $categories = Category::when($searchKey, fn($query) => $query->where("name", "like", "%$searchKey%")->orWhere("slug", "like", "%$searchKey%"))
            ->orderBy('id', 'desc')
            ->paginate($paginateSize);

        return $categories;
    }

    public function list()
    {
        $categories = $this->model->select('id', 'name', 'slug')->get();

        return $categories;
    }

    public function store($request)
    {
        $category = new $this->model();

        $category->name = Str::title($request->name);

        $category->save();

        return $category;
    }

    public function update($request, $id)
    {
        $category = $this->model::find($id);

        $category->name = Str::title($request->name);

        $category->save();

        return $category;
    }

    public function delete($id)
    {
        $category = $this->model::find($id);

        if(!$category){
            throw new CustomException("Category not found.");
        }

        return $category->delete();
    }
}
