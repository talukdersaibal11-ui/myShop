<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\EmployeeLeaveRepository;
use App\Http\Resources\Admin\HRM\EmployeeLeaveResource;
use App\Http\Resources\Admin\HRM\EmployeeLeaveCollection;
use App\Http\Requests\Admin\HRM\StoreEmployeeLeaveRequest;
use App\Http\Requests\Admin\HRM\UpdateEmployeeLeaveRequest;

class EmployeeLeaveController extends BaseController
{
    protected $repository;

    public function __construct(EmployeeLeaveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $departments = $this->repository->index($request);

        $departments = new EmployeeLeaveCollection($departments);

        return $this->sendResponse($departments, 'Department List');
    }

    public function store(StoreEmployeeLeaveRequest $request)
    {
        try {
            $department = $this->repository->store($request);

            $department = new EmployeeLeaveResource($department);

            return $this->sendResponse($department, 'Department Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $department = $this->repository->show($id);

            $department = new EmployeeLeaveResource($department);

            return $this->sendResponse($department, "Department Single View");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateEmployeeLeaveRequest $request, $id)
    {
        try {
            $department = $this->repository->update($request, $id);

            $department = new EmployeeLeaveResource($department);

            return $this->sendResponse($department, 'Department Update Successfully');
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

            return $this->sendResponse(null, "Department delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('Department is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
