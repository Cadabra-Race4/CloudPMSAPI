<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::POST('/login', [AuthController::class, 'login'])->name("api.login");
Route::POST('/forgot-password', [AuthController::class, 'ForgotPassword'])->name("api.forgotPassword");

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/me', 'me')->name("api.user.me");
        Route::post('/profile/update', 'UpdateUserInfo')->name("api.user.update");
        Route::post('/profile/change-password', 'ChangeUserPassword')->name("api.user.change-password");
    });
    Route::POST('/logout', [AuthController::class, 'logout'])->name("api.logout");
});
