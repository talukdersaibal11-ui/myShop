<?php

namespace App\Classes;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

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

    public static function uploadFile($file, $uploadPath, $oldFilePath = null, $key = '')
    {
        if ($file) {
            // Delete old file
            if ($oldFilePath) {
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            $uploadPath = "uploads/" . $uploadPath;
            $extension  = strtolower($file->getClientOriginalExtension());
            $fileName   = $key . "_" . time() . '.' . $extension;

            $file->move(public_path($uploadPath), $fileName);

            return $uploadPath . '/' . $fileName;
        }

        return null;
    }


    public static function getUpperCase($text = null)
    {
        if($text !=  null){
            return Str::title($text);
        }

        return 'N/A';
    }

    public static function generate(Model $model, string $column = 'code', string $prefix = 'GD', int $length = 4): string
    {
        $latest = $model->newQuery()
            ->orderByDesc($column)
            ->value($column);

        if ($latest) {
            $number = (int) str_replace($prefix . '-', '', $latest);
            $number++;
        } else {
            $number = 1;
        }

        $code = $prefix . str_pad($number, $length, '0', STR_PAD_LEFT);

        while ($model->newQuery()->where($column, $code)->exists()) {
            $number++;
            $code = $prefix . str_pad($number, $length, '0', STR_PAD_LEFT);
        }

        return $code;
    }
}
