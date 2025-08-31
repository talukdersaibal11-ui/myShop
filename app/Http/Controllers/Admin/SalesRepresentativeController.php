<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\SalesRepresentativeRepository;
use App\Http\Resources\Admin\SaleRepresentiveResource;
use App\Http\Resources\Admin\SaleRepresentiveCollection;
use App\Http\Requests\Admin\StoreSalesRepresentiveRequest;
use App\Http\Requests\Admin\UpdateSalesRepresentiveRequest;

class SalesRepresentativeController extends BaseController
{
    protected $repository;

    public function __construct(SalesRepresentativeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $allSr = $this->repository->index($request);

        $allSr = new SaleRepresentiveCollection($allSr);

        return $this->sendResponse($allSr, 'SR List');
    }

    public function list()
    {
        try {
            $sr = $this->repository->list();

            return $this->sendResponse($sr, 'SR list');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this->sendError(__("common.commonError"));
        }
    }

    public function store(StoreSalesRepresentiveRequest $request)
    {
        try {
            $sr = $this->repository->store($request);

            $sr = new SaleRepresentiveResource($sr);

            return $this->sendResponse($sr, 'SR Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateSalesRepresentiveRequest $request, $id)
    {
        try {
            $sr = $this->repository->update($request, $id);

            $sr = new SaleRepresentiveResource($sr);

            return $this->sendResponse($sr, 'SR Update Successfully');
        } catch (CustomException $exception) {
            return $this->sendError('SR is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, "SR delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('SR is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
