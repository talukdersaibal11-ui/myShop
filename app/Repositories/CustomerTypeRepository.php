<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Models\CustomerType;
use App\Exceptions\CustomException;

class CustomerTypeRepository
{
    public function __construct(protected CustomerType $model) {}

    public function index($request)
    {
        $customerType = $this->model::all();

        return $customerType;
    }

    public function list()
    {
        $customerType = $this->model::select("name", "slug")->get();

        return $customerType;
    }

    public function store($request)
    {
        $customerType = new $this->model();

        $customerType->name = Helper::getUpperCase($request->name);
        $customerType->slug = $request->name;

        $customerType->save();

        return $customerType;
    }

    public function update($request, $id)
    {
        $customerType = $this->model::find($id);

        if (!$customerType) {
            throw new CustomException("Godown not found");
        }

        $customerType->name = Helper::getUpperCase($request->name);
        $customerType->slug = $request->name;

        $customerType->save();

        return $customerType;
    }

    public function delete($id)
    {
        $customerType = $this->model::find($id);

        if (!$customerType) {
            throw new CustomException("Customer Type not found");
        }

        return $customerType->delete();
    }
}
