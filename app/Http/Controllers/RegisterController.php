<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register user account
     * @param $request
     * 
     */
    private function Register (Request $request) {
        User::insert([]);
    } 
}
