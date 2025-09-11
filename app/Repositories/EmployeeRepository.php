<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Classes\Helper;
use App\Models\Employee;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    public function __construct(protected Employee $model) {}

    public function index($request)
    {
        $paginateSize = Helper::checkPaginateSize($request);
        $searchKey    = $request->input("search_key", null);

        $employees = $this->model::with(["user:id,name,email,phone_number,address"])
            ->when(
                $searchKey,
                fn($query) =>
                $query->where(function ($q) use ($searchKey) {
                    $q->where("name", "like", "%{$searchKey}%");
                })
            )
            ->paginate($paginateSize);


        return $employees;
    }

    public function list()
    {
        $employees = $this->model::select("id", "name", "user_id")->get();

        return $employees;
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $userObj = new User();

            $userObj->godown_code  = $request->godown_code;
            $userObj->name         = $request->name;
            $userObj->email        = $request->email;
            $userObj->phone_number = $request->phone_number;
            $userObj->address      = $request->address;
            $userObj->password     = Hash::make('123456789');
            $userObj->is_verified  = true;
            $userObj->role         = StatusEnum::EMPLOYEE;
            $userObj->status       = StatusEnum::ACTIVE;

            if($request->hasFile('file')){
                // $userObj->file_path = Helper::uploadFile($request->file, $userObj->uploadPath);
            }

            $res = $userObj->save();

            if($res){
                $employee = new $this->model();

                $employee->user_id      = $userObj->id;
                $employee->nid          = $request->nid;
                $employee->department   = $request->department;
                $employee->designation  = $request->designation;
                $employee->basic_salary = $request->basic_salary;
                $employee->join_date    = $request->join_date;

                $employee->save();
            }

            DB::commit();

            $employee->load('user');

            return $employee;
        } catch (Exception $exception) {
            DB::rollback();
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        $employee = $this->model::with("user:id,name,email,phone_number,address")->find($id);

        if(!$employee){
            throw new CustomException("Employee not found.");
        }

        return $employee;
    }

    public function update($request, $id)
    {
        $sr = $this->model::find($id);

        if (!$sr) {
            throw new CustomException("Employee not found");
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
            throw new CustomException("Employee not found");
        }

        return $sr->delete();
    }
}
