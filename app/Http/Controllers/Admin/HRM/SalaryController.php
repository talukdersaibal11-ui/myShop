<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use App\Http\Requests\Admin\HRM\StoreSalaryRequest;
use App\Http\Requests\Admin\HRM\UpdateSalaryRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\SalaryRepository;
use App\Http\Resources\Admin\HRM\SalaryResource;
use App\Http\Resources\Admin\HRM\SalaryCollection;

class SalaryController extends BaseController
{
    protected $repository;

    public function __construct(SalaryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $departments = $this->repository->index($request);

        $departments = new SalaryCollection($departments);

        return $this->sendResponse($departments, 'Department List');
    }

    public function store(StoreSalaryRequest $request)
    {
        try {
            $department = $this->repository->store($request);

            $department = new SalaryResource($department);

            return $this->sendResponse($department, 'Department Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $department = $this->repository->show($id);

            $department = new SalaryResource($department);

            return $this->sendResponse($department, "Department Single View");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateSalaryRequest $request, $id)
    {
        try {
            $department = $this->repository->update($request, $id);

            $department = new SalaryResource($department);

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
