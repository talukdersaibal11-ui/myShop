<?php

namespace App\Http\Controllers\Admin;

use App\Classes\BaseController;
use App\Exceptions\CustomException;
use App\Http\Requests\Admin\StoreColorRequest;
use App\Http\Requests\Admin\UpdateColorRequest;
use App\Http\Resources\Admin\ColorCollection;
use App\Http\Resources\Admin\ColorResource;
use App\Repositories\ColorRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ColorController extends BaseController
{
    protected $repository;

    public function __construct(ColorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $colors = $this->repository->index($request);

            $colors = new ColorCollection($colors);

            return $this->sendResponse($colors, 'Color List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function list()
    {
        try {
            $colors = $this->repository->list();

            $colors = new ColorCollection($colors);

            return $this->sendResponse($colors, 'Color List');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function store(StoreColorRequest $request)
    {
        try {
            $color = $this->repository->store($request);

            $color = new ColorResource($color);

            return $this->sendResponse($color, 'Color create successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateColorRequest $request, $id)
    {
        try {
            $color = $this->repository->update($request, $id);

            $color = new ColorResource($color);

            return $this->sendResponse($color, 'Color update successfully');
        } catch(CustomException $exception){
            return $this->sendResponse($color, "Color update success");
        }
        catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, 'Color delete successfully');
        } catch (CustomException $exception) {
            return $this->sendResponse(null, "Color not found");
        }
        catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
