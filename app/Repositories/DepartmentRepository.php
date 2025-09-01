<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Models\Department;
use App\Exceptions\CustomException;

class DepartmentRepository
{
    public function __construct(protected Department $model) {}

    public function index($request)
    {
        $departments = $this->model::all();

        return $departments;
    }

    public function list()
    {
        $departments = $this->model::select("id", "name", "slug")->get();

        return $departments;
    }

    public function store($request)
    {
        $department = new $this->model();

        $department->name = Helper::getUpperCase($request->name);
        $department->slug = $request->name;

        $department->save();

        return $department;
    }

    public function show($id)
    {
        $department = $this->model::find($id);

        if(!$department){
            throw new CustomException("Department Not Found.");
        }

        return $department;
    }

    public function update($request, $id)
    {
        $department = $this->model::find($id);

        if (!$department) {
            throw new CustomException("Department not found");
        }

        $department->name         = Helper::getUpperCase($request->name);
        $department->slug         = $request->name;

        $department->save();

        return $department;
    }

    public function delete($id)
    {
        $department = $this->model::find($id);

        if (!$department) {
            throw new CustomException("Department not found");
        }

        return $department->delete();
    }
}
