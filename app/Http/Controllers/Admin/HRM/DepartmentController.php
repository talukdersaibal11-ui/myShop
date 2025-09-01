<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\DepartmentRepository;
use App\Http\Resources\Admin\HRM\DepartmentResource;
use App\Http\Resources\Admin\HRM\DepartmentCollection;
use App\Http\Requests\Admin\HRM\StoreDepartmentRequest;
use App\Http\Requests\Admin\HRM\UpdateDepartmentRequest;

class DepartmentController extends BaseController
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $departments = $this->repository->index($request);

        $departments = new DepartmentCollection($departments);

        return $this->sendResponse($departments, 'Department List');
    }

    public function list()
    {
        $departments = $this->repository->list();

        $departments = new DepartmentCollection($departments);

        return $this->sendResponse($departments, 'Department List');
    }

    public function store(StoreDepartmentRequest $request)
    {
        try {
            $department = $this->repository->store($request);

            $department = new DepartmentResource($department);

            return $this->sendResponse($department, 'Department Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = $this->repository->update($request, $id);

            $department = new DepartmentResource($department);

            return $this->sendResponse($department, 'Department Update Successfully');
        } catch (CustomException $exception) {
            return $this->sendError('Department is not found.');
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
