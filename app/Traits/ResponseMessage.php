<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

Trait ResponseMessage {


    /**
     * Default success message
     *
     * @param $content
     * @return JsonResponse
     */
    public function successMessage($content): JsonResponse
    {
        return response()->json([
                "status" => true,
                "message" => [$content]
            ]);
    }


    /**
     * Default error message
     *
     * @param $message
     * @param integer $code
     * @return JsonResponse
     */
    public function errorMessage($message, int $code): JsonResponse
    {
        return response()->json([
            "status" => false,
            "message" => [$message]
        ], $code);
    }
}
