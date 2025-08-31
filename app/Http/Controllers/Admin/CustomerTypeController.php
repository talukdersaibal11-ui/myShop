<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\CustomerTypeRepository;
use App\Http\Resources\Admin\CustomerTypeResource;
use App\Http\Resources\Admin\CustomerTypeCollection;
use App\Http\Requests\Admin\StoreCustomerTypeRequest;
use App\Http\Requests\Admin\UpdateCustomerTypeRequest;

class CustomerTypeController extends BaseController
{
    protected $repository;

    public function __construct(CustomerTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $godowns = $this->repository->index($request);

        $godowns = new CustomerTypeCollection($godowns);

        return $this->sendResponse($godowns, 'Godown List');
    }

    public function list()
    {
        $godowns = $this->repository->list();

        $godowns = new CustomerTypeCollection($godowns);

        return $this->sendResponse($godowns, 'Godown List');
    }

    public function store(StoreCustomerTypeRequest $request)
    {
        try {
            $customerType = $this->repository->store($request);

            $customerType = new CustomerTypeResource($customerType);

            return $this->sendResponse($customerType, 'Customer Type Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateCustomerTypeRequest $request, $id)
    {
        try {
            $customerType = $this->repository->update($request, $id);

            $customerType = new CustomerTypeResource($customerType);

            return $this->sendResponse($customerType, 'Customer Type Update Successfully');
        } catch (CustomException $exception) {
            return $this->sendError('Customer Type is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, "Customer Type delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('Customer Type is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
