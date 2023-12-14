<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    public function successResponse(
        mixed $data,
        string $message = "operation was successfully!",
        int $code = 200
    ): JsonResponse
    {
        return response()->json([
            "data"=> $data,
            "message"=> $message,
            "code"=> $code,
        ]);
    }

    public function errorResponse(string $message = "an error accused", $code=404): JsonResponse
    {
        return response()->json([
            "message"=> $message,
            "code"=> $code
        ]);
    }
}
