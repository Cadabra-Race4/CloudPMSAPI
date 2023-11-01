<?php

namespace App\Http\Controllers;

use App\Handler\ApiResponseHandler;
use App\Http\Requests\Leave\CreateLeaveTypeRequest;
use App\Http\Requests\Leave\UpdateLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    protected $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponseHandler();
    }

    /**
     * Get all leave type data
     * @return json
     */
    public function getAllLeaveType () {
        try {
            $result_data = LeaveType::getAll();
            if ($result_data) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }

    /**
     * Create new leave type data
     * @param $request
     * @return json
     */
    public function createNewLeaveType (CreateLeaveTypeRequest $request) {
        try {
            $result_create = LeaveType::createInfo($request->all());
            dd($result_create);
            if ($result_create) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }

    /**
     * Update leave type data information
     * @param $request
     * @return json
     */
    public function updateInfoLeaveType(UpdateLeaveTypeRequest $request) {
        try {
            $result_update = LeaveType::updateInfo($request->all());
            if ($result_update) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);    
        }
    }

    /**
     * Delete leave type data information
     * @param $request
     * @return json
     */
    public function deleteInfoLeaveType (UpdateLeaveTypeRequest $request) {
        try {
            $result_delete = LeaveType::deleteInfo($request->id);
            if ($result_delete) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }
}
