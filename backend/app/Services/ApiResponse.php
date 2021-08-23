<?php

namespace App\Services;

class ApiResponse
{
    /**
     * Return a success response.
     *
     * @param array $data
     * @param integer $code
     * @return \Illuminate\Http\Response
     */
    public function success($data, $code = 200)
    {
        return response()->json($data, $code);
    }

    /**
     * Returns an failed response.
     *
     * @param string $message
     * @param integer $code
     * @param array $errors
     * @return \Illuminate\Http\Response
     */
    public function failed($message, $code = 500, $errors = [])
    {
        $body = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'status' => $code,
        ];

        return response()->json($body, $code);
    }
}
