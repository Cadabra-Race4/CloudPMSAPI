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
        $rules = config('API_RULES');
        $statusCode     = $rules[$key]['code'];
        $message        = $rules[$key]['message'];
        $description    = $rules[$key]['description'];
        $responseData = [
            'status' 		=>  $statusCode,
            'message' 		=>  $message,
            'description'   =>  $description,
            'responseTime'	=>	date('c'),
            'results' 		=>	empty($data) ? [] : $data
        ];
        return $responseData;
    }

    /**
     * Return a error JSON response.
     * @param number $httpCode
     * @return array
     */
    public function errorResponse($httpCode = "FATALERROR")
    {
        $rules = config('API_RULES');
        $statusCode     = $rules[$httpCode]['code'];
        $message        = $rules[$httpCode]['message'];
        $description    = $rules[$httpCode]['description'];
        $responseData = [
            'status' 		=>  $statusCode,
            'message' 		=>  $message,
            'description'   =>  $description,
            'responseTime'	=>	date('c'),
            'results' 		=>	[]
        ];

        return $responseData;
    }
}