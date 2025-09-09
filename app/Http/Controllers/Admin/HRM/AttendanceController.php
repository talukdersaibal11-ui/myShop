<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\AttendanceRepository;
use App\Http\Resources\Admin\HRM\AttendanceResource;
use App\Http\Resources\Admin\HRM\AttendanceCollection;
use App\Http\Requests\Admin\HRM\StoreAttendanceRequest;
use App\Http\Requests\Admin\HRM\UpdateAttendanceRequest;

class AttendanceController extends BaseController
{
    protected $repository;

    public function __construct(AttendanceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $departments = $this->repository->index($request);

        $departments = new AttendanceCollection($departments);

        return $this->sendResponse($departments, 'Department List');
    }

    public function store(StoreAttendanceRequest $request)
    {
        try {
            $department = $this->repository->store($request);

            $department = new AttendanceResource($department);

            return $this->sendResponse($department, 'Department Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $department = $this->repository->show($id);

            $department = new AttendanceResource($department);

            return $this->sendResponse($department, "Department Single View");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateAttendanceRequest $request, $id)
    {
        try {
            $department = $this->repository->update($request, $id);

            $department = new AttendanceResource($department);

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
