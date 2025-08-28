<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use Illuminate\Support\Facades\Log;
use App\Repositories\CategoryRepository;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Requests\Admin\StoreCategoryRequest;

class CategoryController extends BaseController
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
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
}
