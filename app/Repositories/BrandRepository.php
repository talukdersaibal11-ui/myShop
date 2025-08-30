<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Exceptions\CustomException;

class BrandRepository
{
    public function __construct(protected Brand $model){}

    public function index($request)
    {
        $brands = $this->model::all();

        return $brands;
    }

    public function list()
    {
        $brands = $this->model::select('id', 'name', 'slug');

        return $brands;
    }

    public function store($request)
    {
        $brand = new $this->model();

        $brand->name = $request->name;

        $brand->save();

        return $brand;
    }

    public function update($request, $id)
    {
        $brand = $this->model::find($id);

        if(!$brand){
            throw new CustomException("Brand not found");
        }

        $brand->name = $request->name;

        $brand->save();

        return $brand;
    }

    public function delete($id)
    {
        $brand = $this->model::find($id);

        if(!$brand){
            throw new CustomException("Brand not found");
        }

        return $brand->delete();
    }
}
