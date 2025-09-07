<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\EmployeeRepository;
use App\Http\Resources\Admin\HRM\EmployeeResource;
use App\Http\Resources\Admin\HRM\EmployeeCollection;
use App\Http\Requests\Admin\HRM\StoreEmployeeRequest;
use App\Http\Requests\Admin\HRM\UpdateEmployeeRequest;

class EmployeeController extends BaseController
{
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $employees = $this->repository->index($request);

        $employees = new EmployeeCollection($employees);

        return $this->sendResponse($employees, 'Employee List');
    }

    public function list()
    {
        $employees = $this->repository->list();

        $employees = new EmployeeCollection($employees);

        return $this->sendResponse($employees, 'Employee List');
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = $this->repository->store($request);

            $employee = new EmployeeResource($employee);

            return $this->sendResponse($employee, 'Employee Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $employee = $this->repository->show($id);

            $employee = new EmployeeResource($employee);

            return $this->sendResponse($employee, 'Employee Single View');
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        try {
            $employee = $this->repository->update($request, $id);

            $employee = new EmployeeResource($employee);

            return $this->sendResponse($employee, 'Employee Update Successfully');
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, "Employee delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
