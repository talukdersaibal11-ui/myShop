<?php

namespace App\Classes;

class Helper
{
    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'result'  => $result
        ];

        return response()->json($response, $code);
    }

    public static function sendError($message, $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public static function checkPaginateSize($request)
    {
        $paginateSize = $request->paginate_size ?? 100;
        $paginateSize = $paginateSize > 1000 ? 10 : $paginateSize;

        return $paginateSize;
    }
}
