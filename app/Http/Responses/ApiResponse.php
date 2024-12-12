<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(string $message = 'Success', $data = null): JsonResponse 
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function error(string $message = 'Error', $errors = null, int $code = 400): JsonResponse 
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}