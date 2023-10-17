<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Unauthorized'
                ],401);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'userData' => [
                    'id' => $user->id,
                    'role' => 'admin',
                    'fullName' => $user->name ?? "",
                    'email' => $user->email ?? "",
                    'username' => "localuser",
                ],
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ],500);
        }
    }

    /**
     * Restore account password forget password
     * @param string email
     * @return <json>
     */
    public function ForgotPassword (ForgotPasswordRequest $request) {
        try {
            $email = $request->email;
            $randomPassword = Str::random(6);
    
            $user = User::where('email', $email)->first();
            if (empty($user)) {
                return response()->json([
                    'status_code' => 404,
                    'message' => 'No required email found.',
                ],404);
            }
            $user->password = $randomPassword;
            $user->save();
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $th,
            ],500);
        }
    }
}
