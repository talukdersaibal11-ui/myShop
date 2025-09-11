<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Exceptions\CustomException;

class UnitRepository
{
    public function __construct(protected Unit $model) {}

    public function index($request)
    {
        $units = $this->model::orderBy('id', 'desc')->get();

        return $units;
    }

    public function list()
    {
        $units = $this->model::select("id", "name", "slug", 'symbol')->get();

        return $units;
    }

    public function store($request)
    {
        $unit = new $this->model();

        $unit->name   = $request->name;
        $unit->symbol = strtoupper($request->symbol);

        $unit->save();

        return $unit;
    }

    public function update($request, $id)
    {
        $unit = $this->model::find($id);

        if (!$unit) {
            throw new CustomException("Unit not found");
        }

        $unit->name   = $request->name;
        $unit->symbol = $request->symbol;

        $unit->save();

        return $unit;
    }

    public function delete($id)
    {
        $unit = $this->model::find($id);

        if (!$unit) {
            throw new CustomException("Unit not found");
        }

        return $unit->delete();
    }
}
