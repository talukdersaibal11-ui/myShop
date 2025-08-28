<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\CategoryRepository;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Resources\Admin\CategoryCollection;

class CategoryController extends BaseController
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->repository->index($request);

            $categories = new CategoryCollection($categories);

            return $this->sendResponse($categories, "User List");
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->repository->store($request);

            $category = new CategoryResource($category);

            return $this->sendResponse($category, 'Category created successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = $this->repository->update($request, $id);

            $category = new CategoryResource($category);

            return $this->sendResponse($category, 'Category updated successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, 'Category deleted.');
        }catch(CustomException $exception){
            $this->sendError($exception->getMessage());
        }
         catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
