<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Models\Designation;
use App\Exceptions\CustomException;

class DesignationRepository
{
    public function __construct(protected Designation $model) {}

    public function index($request)
    {
        $designations = $this->model::all();

        return $designations;
    }

    public function list()
    {
        $designations = $this->model::select("id", "name", "slug")->get();

        return $designations;
    }

    public function store($request)
    {
        $designation = new $this->model();

        $designation->name = Helper::getUpperCase($request->name);
        $designation->slug = $request->name;

        $designation->save();

        return $designation;
    }

    public function update($request, $id)
    {
        $designation = $this->model::find($id);

        if (!$designation) {
            throw new CustomException("Designation not found");
        }

        $designation->name         = Helper::getUpperCase($request->name);
        $designation->slug         = $request->name;

        $designation->save();

        return $designation;
    }

    public function delete($id)
    {
        $designation = $this->model::find($id);

        if (!$designation) {
            throw new CustomException("Designation not found");
        }

        return $designation->delete();
    }
}
