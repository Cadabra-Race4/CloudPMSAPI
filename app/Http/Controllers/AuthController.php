<?php

namespace App\Http\Controllers;

use App\Handler\ApiResponseHandler;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Repositories\SendmailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $mail;
    protected $apiResponse;

    public function __construct()
    {
        $this->mail = new SendmailRepository();
        $this->apiResponse = new ApiResponseHandler();
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            
            if (!Auth::attempt($credentials)) {
                $result = $this->apiResponse->errorResponse("NOTFOUND");
                return response()->json($result, $result['status']);
            }
            
            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            $userData = [
                'id' => $user->id,
                'role' => 'admin',
                'fullName' => $user->name ?? "",
                'email' => $user->email ?? "",
                'username' => "localuser",
                'token_type' => 'Bearer',
                'access_token' => $tokenResult,
            ];
            $result = $this->apiResponse->SuccessResponse($userData);
            return response()->json($result);
        } catch (\Exception $error) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }

    /**
     * Restore account password forget password
     * @param string email
     * @return <json>
     */
    public function ForgotPassword (Request $request) {
        try {
            $email = $request->email;
            $randomPassword = Str::random(6);
    
            $user = User::where('email', $email)->first();
            if (empty($user)) {
                $result = $this->apiResponse->errorResponse("NOTFOUND");
                return response()->json($result, $result['status']);
            }
            $user->password = $randomPassword;
            $user->save();

            $toName = "ThanhDang";
            $data = array('name' => $toName, "password" => $randomPassword);
            $this->mail->setNameTo($toName);
            $this->mail->setMailTo($email);
            $this->mail->SendMailForgotPassword($data);

            $result = $this->apiResponse->SuccessResponse();
            return response()->json($result);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }
    
    public function me(Request $request)
    {        
        $user = Auth::user();
        return response()->json([
            'userData' => [
                'id' => $user->id,
                'role' => $user->roles->pluck('name')->first(),
                'fullName' => $user->name ?? "",
                'email' => $user->email ?? "",
                'username' => "localuser",
            ]
        ]);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Logged out',
        ]);
    }
}
