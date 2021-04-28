<?php

namespace App\Traits;


Trait ResponseMessage {


    /**
     * Default success message
     *
     * @param mixed $content
     * @return \Illuminate\Http\JsonResponse
     */
    public function successMessage($content)
    {
        return response()->json([
                "status" => true,
                "message" => [$content]
            ]);
    }


    /**
     * Default error message
     *
     * @param mixed $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorMessage($message, $code)
    {
        return response()->json([
            "status" => false,
            "message" => [$message]
        ], $code);
    }
}
