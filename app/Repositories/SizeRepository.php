<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Exceptions\CustomException;
use App\Models\Size;

class SizeRepository
{
    public function __construct(protected Size $model){}

    public function index($request)
    {
        $sizes = $this->model::all();

        return $sizes;
    }

    public function list()
    {
        $sizes = $this->model->select('id', 'name', 'slug');

        return $sizes;
    }

    public function store($request)
    {
        $size = new $this->model();

        $size->name = Helper::getUpperCase($request->name);
        $size->code = strtoupper($request->code);

        $size->save();

        return $size;
    }

    public function update($request, $id)
    {
        $size = $this->model::find($id);

        if(!$size){
            throw new CustomException("Size Not Found");
        }

        $size->name = Helper::getUpperCase($request->name);
        $size->code = strtoupper($request->code);

        $size->save();

        return $size;
    }

    public function delete($id)
    {
        $size = $this->model::find($id);

        if (!$size) {
            throw new CustomException("Size Not Found");
        }

        return $size->delete();
    }
}
