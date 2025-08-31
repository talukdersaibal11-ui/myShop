<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\SizeRepository;
use App\Http\Resources\Admin\SizeResource;
use App\Http\Requests\Admin\StoreSizeRequest;
use App\Http\Requests\Admin\UpdateSizeRequest;
use App\Http\Resources\Admin\SizeCollection;

class SizeController extends BaseController
{
    protected $repository;

    public function __construct(SizeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $sizes = $this->repository->index($request);

        $sizes = new SizeCollection($sizes);

        return $this->sendResponse($sizes, 'Size List');
    }

    public function list()
    {
        $sizes = $this->repository->list();

        $sizes = new SizeCollection($sizes);

        return $this->sendResponse($sizes, 'Size List');
    }

    public function store(StoreSizeRequest $request)
    {
        try {
            $size = $this->repository->store($request);

            $size = new SizeResource($size);

            return $this->sendResponse($size, 'Size Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateSizeRequest $request, $id)
    {
        try {
            $size = $this->repository->update($request, $id);

            $size = new SizeResource($size);

            return $this->sendResponse($size, 'Size Update Successfully');
        }catch(CustomException $exception){
            return $this->sendError('Size is not found.');
        }
         catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, "Size delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('Size is not found.');
        }
         catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
