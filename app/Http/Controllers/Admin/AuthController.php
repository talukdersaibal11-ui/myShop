<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Repositories\AuthRepository;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\Admin\AuthResource;

class AuthController extends BaseController
{
    protected $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }
    public function login(LoginRequest $request)
    {
        try {
            $result = $this->repository->login($request);

            $data = [
                "token" => $result["token"],
                "user"  => new AuthResource($result["user"]),
            ];

            return $this->sendResponse($data, "Login successfully");
        } catch (CustomException $exception) {
            return $this->sendError('User Not Found');
        }catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }
}
