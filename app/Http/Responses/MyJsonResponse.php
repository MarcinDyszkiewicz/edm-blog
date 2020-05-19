<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class MyJsonResponse extends JsonResponse
{
    public function __construct(
        $data = null,
        $status = 200,
        $success = true,
        $message = 'Ok',
        $headers = [],
        $options = 0
    ) {
        $allData = ['data' => $data, 'success' => $success, 'message' => $message];
        parent::__construct($allData, $status, $headers, $options);
    }
}
