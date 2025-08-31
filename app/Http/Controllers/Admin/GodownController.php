<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\GodownRepository;
use App\Http\Resources\Admin\GodownResource;
use App\Http\Resources\Admin\GodownCollection;
use App\Http\Requests\Admin\StoreGodownRequest;
use App\Http\Requests\Admin\UpdateGodownRequest;

class GodownController extends BaseController
{
    protected $repository;

    public function __construct(GodownRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $godowns = $this->repository->index($request);

        $godowns = new GodownCollection($godowns);

        return $this->sendResponse($godowns, 'Godown List');
    }

    public function list()
    {
        $godowns = $this->repository->list();

        $godowns = new GodownCollection($godowns);

        return $this->sendResponse($godowns, 'Godown List');
    }

    public function store(StoreGodownRequest $request)
    {
        try {
            $godown = $this->repository->store($request);

            $godown = new GodownResource($godown);

            return $this->sendResponse($godown, 'Godown Created Successfully');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function update(UpdateGodownRequest $request, $id)
    {
        try {
            $godown = $this->repository->update($request, $id);

            $godown = new GodownResource($godown);

            return $this->sendResponse($godown, 'Godown Update Successfully');
        } catch (CustomException $exception) {
            return $this->sendError('Godown is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->sendResponse(null, "Godown delete successfully.");
        } catch (CustomException $exception) {
            return $this->sendError('Godown is not found.');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
