<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Exceptions\CustomException;
use App\Models\Color;

class ColorRepository
{
    public function __construct(protected Color $model){}

    public function index($request)
    {
        $colors = $this->model::orderBy('id','desc')->get();

        return $colors;
    }

    public function list()
    {
        $colors = $this->model::select("id", "name", "hex_code")->get();

        return $colors;
    }

    public function store($request)
    {
        $color = new $this->model();

        $color->name     = Helper::getUpperCase($request->name);
        $color->hex_code = $request->hex_code;

        $color->save();

        return $color;
    }

    public function update($request, $id)
    {
        $color = $this->model::find($id);

        if(!$color){
            throw new CustomException("Color not found");
        }

        $color->name     = Helper::getUpperCase($request->name);
        $color->hex_code = $request->hex_code;

        $color->save();

        return $color;
    }

    public function delete($id)
    {
        $color = $this->model::find($id);

        if (!$color) {
            throw new CustomException("Color not found");
        }

        return $color->delete();
    }
}
