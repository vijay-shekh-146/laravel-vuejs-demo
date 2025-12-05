<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($code = 200, $message = "Success", $data = null)
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($code = 400, $message = "Error", $errors = null)
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
