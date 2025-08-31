<?php

namespace App\Repositories;

use App\Models\Godown;
use App\Classes\Helper;
use App\Exceptions\CustomException;

class GodownRepository
{
    public function __construct(protected Godown $model) {}

    public function index($request)
    {
        $godowns = $this->model::all();

        return $godowns;
    }

    public function list()
    {
        $godowns = $this->model::select("id", "name", "code")->get();

        return $godowns;
    }

    public function store($request)
    {
        $godown = new $this->model();

        $godown->name         = Helper::getUpperCase($request->name);
        $godown->slug         = $request->name;
        $godown->code         = Helper::generate($this->model, 'code', 'GD');
        $godown->manager      = Helper::getUpperCase($request->manager);
        $godown->phone_number = $request->phone_number;
        $godown->address      = $request->address;
        $godown->prefix       = strtoupper($request->prefix);

        $godown->save();

        return $godown;
    }

    public function update($request, $id)
    {
        $godown = $this->model::find($id);

        if (!$godown) {
            throw new CustomException("Godown not found");
        }

        $godown->name         = Helper::getUpperCase($request->name);
        $godown->slug         = $request->name;
        $godown->manager      = Helper::getUpperCase($request->manager);
        $godown->phone_number = $request->phone_number;
        $godown->address      = $request->address;

        $godown->save();

        return $godown;
    }

    public function delete($id)
    {
        $godown = $this->model::find($id);

        if (!$godown) {
            throw new CustomException("Godown not found");
        }

        return $godown->delete();
    }
}
