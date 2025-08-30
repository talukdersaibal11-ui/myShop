<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\BrandRepository;
use App\Http\Resources\Admin\BrandResource;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Http\Resources\Admin\BrandCollection;

class BrandController extends BaseController
{
    protected $repository;

    public function __construct(BrandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $brands = $this->repository->index($request);

            $brands = new BrandCollection($brands);

            return $this->sendResponse($brands, 'Brand List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function list()
    {
        try {
            $brands = $this->repository->list();

            $brands = new BrandCollection($brands);

            return $this->sendResponse($brands, 'Brand List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function store(StoreBrandRequest $request)
    {
        try {
            $brand = $this->repository->store($request);

            $brand = new BrandResource($brand);

            return $this->sendResponse($brand, 'Brand Create Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        try {
            $brand = $this->repository->update($request, $id);


        } catch(CustomException $exception){
            return $this->sendError($exception);
        }
        catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $brand = $this->repository->delete($id);
            return $this->sendResponse(null, 'Brand Deleted successfully.');
        }catch(CustomException $exception){
            return $this->sendError($exception);
        }
         catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
