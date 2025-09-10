<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Exceptions\CustomException;
use App\Models\SubCategory;

class SubCategoryRepository
{
    public function __construct(protected SubCategory $model){}

    public function index($request)
    {
        $paginateSize = $request->input('paginate_size', null);
        $paginateSize = Helper::checkPaginateSize($request);
        $searchKey    = $request->input('search_key', null);

        $subCategories = $this->model::with('category:id,name')
        ->when($searchKey, fn($query) => $query->where("name", "like", "%$searchKey%")->orWhere("slug", "like", "%$searchKey%"))
        ->orderBy('id', 'desc')
        ->paginate($paginateSize);

        return $subCategories;
    }

    public function list()
    {
        $subCategories = $this->model->select('id', 'name', 'slug')->get();

        return $subCategories;
    }

    public function store($request)
    {
        $subCategory = new $this->model();

        $subCategory->category_id = $request->category_id;
        $subCategory->name        = $request->name;

        $subCategory->save();

        return $subCategory;
    }

    public function update($request, $id)
    {
        $subCategory = $this->model::find($id);

        if(!$subCategory){
            throw new CustomException("Sub Category not found");
        }

        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;

        $subCategory->save();

        return $subCategory;
    }

    public function delete($request, $id)
    {
        $subCategory = $this->model::find($id);

        if(!$subCategory){
            throw new CustomException("Sub Category not found");
        }

        return $subCategory->delete();
    }
}
