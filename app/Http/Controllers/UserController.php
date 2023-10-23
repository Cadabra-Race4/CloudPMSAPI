<?php

namespace App\Http\Controllers;

use App\Handler\ApiResponseHandler;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponseHandler();
    }

    /**
     * Get user account information
     * @return json
     */
    public function me()
    {
        $user = Auth::user();
        $userData = [
            'id' => $user->id,
            'role' => $user->roles->pluck('name')->first(),
            'fullName' => $user->name ?? "",
            'email' => $user->email ?? "",
            'username' => "localuser",
        ];
        $result = $this->apiResponse->SuccessResponse($userData);
        return response()->json($result);
    }

    /**
     * Update account information
     * @param $request
     * @return json
     */
    public function UpdateUserInfo (UpdateUserInfoRequest $request) {
        try {
            $resultUpdate = User::UpdateUserInfoByEmail($request->all());
            if ($resultUpdate) {
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
