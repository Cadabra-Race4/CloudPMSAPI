<?php

namespace App\Http\Controllers;

use App\Handler\ApiResponseHandler;
use App\Http\Requests\User\ChangeUserPasswordRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Update the login account password
     * @param $request
     * @return json
     */
    public function ChangeUserPassword (ChangeUserPasswordRequest $request) {
        try {
            $user = Auth::user();
            $userData = User::where('email', $user->email)->first();
            
            if (!Hash::check($request->old_password, $userData->password, [])) {
                $result = $this->apiResponse->errorResponse();
                return response()->json($result, $result['status']);
            }

            $resultUpdate = User::UpdateUserInfoByEmail(['password' => Hash::make($request->password)]);
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
