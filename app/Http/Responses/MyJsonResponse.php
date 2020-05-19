<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class MyJsonResponse extends JsonResponse
{
    public function __construct(
        $data = null,
        $success = true,
        $message = 'Ok',
        $status = 200,
        $headers = [],
        $options = 0
    ) {
        $allData = ['data' => $data, 'success' => $success, 'message' => $message];
        parent::__construct($allData, $status, $headers, $options);
    }
}
