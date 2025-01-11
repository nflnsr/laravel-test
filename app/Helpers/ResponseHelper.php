<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Build a response with the given parameters
     * @param int $code
     * @param string $status
     * @param string $message
     * @param mixed $data
     * @param mixed $pagination
     * @return \Illuminate\Http\JsonResponse
     */
    public static function buildResponse($code, $status, $message, $data = null, $pagination = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $code);
    }
}
