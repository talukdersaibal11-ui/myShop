<?php

namespace App\Repositories;

use App\Models\EmployeeLeave;
use App\Exceptions\CustomException;

class EmployeeLeaveRepository
{
    public function __construct(protected EmployeeLeave $model) {}

    public function index($request)
    {
        $attendances = $this->model::all();

        return $attendances;
    }

    public function store($request)
    {
        $attendance = new $this->model();

        $attendance->name = $request->name;

        $attendance->save();

        return $attendance;
    }

    public function show($id)
    {
        return $id;
    }

    public function update($request, $id)
    {
        $brand = $this->model::find($id);

        if (!$brand) {
            throw new CustomException("Attendance not found");
        }

        $brand->name = $request->name;

        $brand->save();

        return $brand;
    }

    public function delete($id)
    {
        $brand = $this->model::find($id);

        if (!$brand) {
            throw new CustomException("Brand not found");
        }

        return $brand->delete();
    }
}
