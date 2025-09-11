<?php

namespace App\Repositories;

use App\Models\LeaveType;
use App\Exceptions\CustomException;

class LeaveTypeRepository
{
    public function __construct(protected LeaveType $model) {}

    public function index($request)
    {
        $leaveTypes = $this->model::orderBy('id', 'desc')->get();

        return $leaveTypes;
    }

    public function store($request)
    {
        $attendance = new $this->model();

        $attendance->name              = $request->name;
        $attendance->max_days_per_year = $request->max_days_per_year;

        $attendance->save();

        return $attendance;
    }

    public function show($id)
    {
        return $id;
    }

    public function update($request, $id)
    {
        $leaveType = $this->model::find($id);

        if (!$leaveType) {
            throw new CustomException("Leave Type not found");
        }

        $leaveType->name              = $request->name;
        $leaveType->max_days_per_year = $request->max_days_per_year;

        $leaveType->save();

        return $leaveType;
    }

    public function delete($id)
    {
        $leaveType = $this->model::find($id);

        if (!$leaveType) {
            throw new CustomException("Leave Type not found");
        }

        return $leaveType->delete();
    }
}
