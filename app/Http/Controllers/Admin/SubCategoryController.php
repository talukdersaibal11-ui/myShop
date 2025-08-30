<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Http\Requests\Admin\StoreSubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\SubCategoryRepository;
use App\Http\Resources\Admin\SubCategoryCollection;
use App\Http\Resources\Admin\SubCategoryResource;

class SubCategoryController extends BaseController
{
    protected $repository;

    public function __construct(SubCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $subCategories = $this->repository->index($request);

            $subCategories = new SubCategoryCollection($subCategories);

            return $this->sendResponse($subCategories, 'Sub Category List');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function list( )
    {
        try {
            $subCategories = $this->repository->list();

            $subCategories = new SubCategoryCollection($subCategories);

            return $this->sendResponse($subCategories, 'Sub Category List');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function store(StoreSubCategoryRequest $request)
    {
        try {
            $subCategory = $this->repository->store($request);

            $subCategory = new SubCategoryResource($subCategory);

            return $this->sendResponse($subCategory, "Sub Category Created Successfully");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function update(UpdateSubCategoryRequest $request, $id)
    {
        try {
            $subCategory = $this->repository->update($request, $id);

            $subCategory = new SubCategoryResource($subCategory);

            return $this->sendResponse($subCategory, "Sub Category Updated Successfully");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $this->repository->delete($request, $id);

            return $this->sendResponse(null, "Sub Category Deleted Successfully");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
