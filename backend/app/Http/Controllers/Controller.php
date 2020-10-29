<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function errorResponse(int $status, string $message): JsonResponse
    {
        return response()->json([
            'error' => $message,
            'data' => null,
        ], $status);
    }

    protected function successResponse($data): JsonResponse
    {
        return response()->json([
            'error' => null,
            'data' => $data,
        ]);
    }
}
