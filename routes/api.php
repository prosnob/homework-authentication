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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::get("user",[PostController::class, "index"]);
Route::get("user",[PostController::class, "store"]);

Route::get("user",[PostController::class, "index"]);
// Route::get("user",[PostController::class, "index"]);
Route::post("user",[PostController::class, "store"]);


// Publice Route
Route::get("user",[UserController::class, "index"]);
Route::get("user/{id}",[UserController::class, "show"]);
Route::get("signin",[UserController::class, "signin"]);
Route::get("login",[UserController::class, "login"]);

Route::get("user",[PostController::class, "index"]);
Route::get("user/{id}",[PostController::class, "show"]);




// Private Route

Route::group(["middleware"=>["auth:sanctum"]],function(){
    Route::post("post",[PostController::class, "store"]);
    Route::put("post",[PostController::class, "update"]);
    Route::delete("post",[PostController::class, "destroy"]);
    Route::post("signout",[UserController::class, "signout"]);
});