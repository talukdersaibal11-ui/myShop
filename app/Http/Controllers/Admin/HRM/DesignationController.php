<?php

namespace App\Http\Controllers\Admin\HRM;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\DesignationRepository;
use App\Http\Resources\Admin\HRM\DesignationResource;
use App\Http\Resources\Admin\HRM\DesignationCollection;
use App\Http\Requests\Admin\HRM\StoreDesignationRequest;
use App\Http\Requests\Admin\HRM\UpdateDesignationRequest;

class DesignationController extends BaseController
{
    protected $repository;

    public function __construct(DesignationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $designations = $this->repository->index($request);

        $designations = new DesignationCollection($designations);

        return $this->sendResponse($designations, 'Designation List');
    }

    public function list()
    {
        $designations = $this->repository->list();

        $designations = new DesignationCollection($designations);

        return $this->sendResponse($designations, 'Designation List');
    }

    public function store(StoreDesignationRequest $request)
    {
        try {
            $designation = $this->repository->store($request);

            $designation = new DesignationResource($designation);

            return $this->sendResponse($designation, 'Designation Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $designation = $this->repository->show($id);

            $designation = new DesignationResource($designation);

            return $this->sendResponse($designation, 'Designation Single View');
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateDesignationRequest $request, $id)
    {
        try {
            $designation = $this->repository->update($request, $id);

            $designation = new DesignationResource($designation);

            return $this->sendResponse($designation, 'Designation Update Successfully');
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

            return $this->sendResponse(null, "Designation delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError($exception->getMessage());
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
