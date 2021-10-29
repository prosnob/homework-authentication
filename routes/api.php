<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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


// Publice Route
Route::get("user",[UserController::class, "index"]);
Route::get("user/{id}",[UserController::class, "show"]);
Route::post("signup",[UserController::class, "signup"]);
Route::post("login",[UserController::class, "login"]);

Route::get("post",[PostController::class, "index"]);
Route::get("post/{id}",[PostController::class, "show"]);


// Private Route

Route::group(["middleware"=>["auth:sanctum"]],function(){
    Route::post("post",[PostController::class, "store"]);
    Route::put("post/{id}",[PostController::class, "update"]);
    Route::delete("post/{id}",[PostController::class, "destroy"]);
    Route::post("signout",[UserController::class, "signout"]);
});