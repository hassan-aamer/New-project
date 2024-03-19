<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    public function respond($data = '', string $message = 'success', int $code = 200): JsonResponse
    {
        if (ob_get_length() > 0)
            ob_end_clean();

        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function success($data, $code = 200, $message = null): JsonResponse
    {
        return response()->json([
            'is_success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error($data = null, $code = 400, $message = null): JsonResponse
    {
        return response()->json([
            'is_success' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
