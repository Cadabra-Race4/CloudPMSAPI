<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectsController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::post('/profile/update', 'UpdateUserInfo')->name("api.user.update");
        Route::get('/me', 'me')->name("api.user.me");
    });
    Route::POST('/logout', [AuthController::class, 'logout'])->name("api.logout");

    //Project
    Route::GET('/projects/list', [ProjectsController::class,'index'])->name('api.projects');
    Route::GET('/projects/{id}/edit', [ProjectsController::class,'edit'])->name('api.projects.edit');
    Route::PUT('projects/{id}', [ProjectsController::class,'update'])->name('api.projects.update');
    Route::DELETE('/projects/{id}', [ProjectsController::class,'destroy'])->name('api.projects.delete');

});
