<?php

namespace App\Helpers;

if (!function_exists('api_response')) {

    function api_response($success, $message, $data = null, $status = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $status);
    }
}
