<?php

namespace App\Repositories;

use App\Classes\Helper;
use App\Exceptions\CustomException;
use App\Models\SalesRepresentative;

class SalesRepresentativeRepository
{
    public function __construct(protected SalesRepresentative $model) {}

    public function index($request)
    {
        $paginateSize = Helper::checkPaginateSize($request);
        $searchKey    = $request->input("search_key", null);

        $sr = $this->model
            ->with(["godown:code,name,address"])
            ->when(
                $searchKey,
                fn($query) =>
                $query->where(function ($q) use ($searchKey) {
                    $q->where("name", "like", "%{$searchKey}%");
                })
            )
            ->paginate($paginateSize);


        return $sr;
    }

    public function list()
    {
        $sr = $this->model::select("id", "name", "employee_code")->get();

        return $sr;
    }

    public function store($request)
    {
        $sr = new $this->model();

        $sr->name            = Helper::getUpperCase($request->name);
        $sr->employee_code   = Helper::generate($this->model, 'employee_code', 'EMP');
        $sr->godown_code     = $request->godown_code;
        $sr->email           = $request->email;
        $sr->phone_number    = $request->phone_number;
        $sr->address         = $request->address;
        $sr->initial_balance = $request->initial_balance;
        $sr->type            = $request->type;

        if($request->hasFile('file')){
            $sr->file_path = Helper::uploadFile($request->file,$sr->uploadPath);
        }

        $sr->save();

        return $sr;
    }

    public function update($request, $id)
    {
        $sr = $this->model::find($id);

        if (!$sr) {
            throw new CustomException("SR not found");
        }

        $sr->name            = Helper::getUpperCase($request->name);
        $sr->godown_code     = $request->godown_code;
        $sr->email           = $request->email;
        $sr->phone_number    = $request->phone_number;
        $sr->address         = $request->address;
        $sr->initial_balance = $request->initial_balance;
        $sr->type            = $request->type;

        $sr->save();

        return $sr;
    }

    public function delete($id)
    {
        $sr = $this->model::find($id);

        if (!$sr) {
            throw new CustomException("SR not found");
        }

        return $sr->delete();
    }
}
