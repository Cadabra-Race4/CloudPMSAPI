<?php 

namespace App\Handler;

class ApiResponseHandler {

    /**
     * Return a success JSON response.
     * @param object $data
     * @return array
     */
    public function SuccessResponse ($data = []) {
        $key = "SUCCESS";
        $rules = config('api-rule.API_RULES');
        $statusCode     = $rules[$key]['status_code'];
        $message        = $rules[$key]['message'];
        $description    = $rules[$key]['description'];
        $responseData = [
            'status' 		=>  $statusCode,
            'message' 		=>  $message,
            'description'   =>  $description,
            'responseTime'	=>	date('c'),
            'results' 		=>	$data
        ];
        return $responseData;
    }

    /**
     * Return a error JSON response.
     * @param number $httpCode
     * @return array
     */
    public function errorResponse($httpCode = "FATAL_ERROR", $data = [])
    {
        $rules = config('api-rule.API_RULES');
        $statusCode     = $rules[$httpCode]['status_code'];
        $message        = $rules[$httpCode]['message'];
        $description    = $rules[$httpCode]['description'];
        $responseData = [
            'status' 		=>  $statusCode,
            'message' 		=>  $message,
            'description'   =>  $description,
            'responseTime'	=>	date('c'),
            'results' 		=>	$data
        ];

        return $responseData;
    }
}