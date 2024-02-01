<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Handler\ApiResponseHandler;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function listUsers(Request $request)
    {
        $result = [];
        $userList = [];
        $users = User::orderBy('created_at', 'DESC')->get();
        foreach ($users as $user)
        {
            $userList[] = [
                'username' => $user->username,
                'fullname' => $user->name,
                'role' => "Admin",
                'email' => $user->email,
                'status' => 'active',
            ];
        }
        var_dump($userList);
    }
}
