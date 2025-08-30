<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\UnitRepository;
use App\Http\Resources\Admin\UnitResource;
use App\Http\Resources\Admin\UnitCollection;
use App\Http\Requests\Admin\StoreUnitRequest;
use App\Http\Requests\Admin\UpdateUnitRequest;

class UnitController extends BaseController
{
    protected $repository;

    public function __construct(UnitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $units = $this->repository->index($request);

            $units = new UnitCollection($units);

            return $this->sendResponse($units, 'Unit List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function list()
    {
        try {
            $units = $this->repository->list();

            $units = new UnitCollection($units);

            return $this->sendResponse($units, 'Unit List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function store(StoreUnitRequest $request)
    {
        try {
            $unit = $this->repository->store($request);

            $unit = new UnitResource($unit);

            return $this->sendResponse($unit, 'Unit create successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateUnitRequest $request, $id)
    {
        try {
            $unit = $this->repository->update($request, $id);

            $unit = new UnitResource($unit);

            return $this->sendResponse($unit, 'Unit update successfully');
        } catch (CustomException $exception) {
            return $this->sendResponse($unit, "Unit update success");
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, 'Unit delete successfully');
        } catch (CustomException $exception) {
            return $this->sendResponse(null, "Unit not found");
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
