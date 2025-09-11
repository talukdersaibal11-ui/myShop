<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use App\Http\Requests\Admin\HRM\StoreLeaveTypeRequest;
use App\Http\Requests\Admin\HRM\UpdateLeaveTypeRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\LeaveTypeRepository;
use App\Http\Resources\Admin\HRM\LeaveTypeResource;
use App\Http\Resources\Admin\HRM\LeaveTypeCollection;

class LeaveTypeController extends BaseController
{
    protected $repository;

    public function __construct(LeaveTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $leaveTypes = $this->repository->index($request);

            $leaveTypes = new LeaveTypeCollection($leaveTypes);

            return $this->sendResponse($leaveTypes, 'Leave Type List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function store(StoreLeaveTypeRequest $request)
    {
        try {
            $leaveType = $this->repository->store($request);

            $leaveType = new LeaveTypeResource($leaveType);

            return $this->sendResponse($leaveType, 'Leave Type Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $department = $this->repository->show($id);

            $department = new LeaveTypeResource($department);

            return $this->sendResponse($department, "Department Single View");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateLeaveTypeRequest $request, $id)
    {
        try {
            $leaveType = $this->repository->update($request, $id);

            $leaveType = new LeaveTypeResource($leaveType);

            return $this->sendResponse($leaveType, 'Leave Type Update Successfully');
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

            return $this->sendResponse(null, "Leave Type delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('Leave Type is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
