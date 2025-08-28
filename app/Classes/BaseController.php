<?php

namespace App\Classes;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $code = 200)
    {
        return Helper::sendResponse($result, $message, $code);
    }

    public function sendError($message, $code = 400)
    {
        return Helper::sendError($message, $code);
    }
}
