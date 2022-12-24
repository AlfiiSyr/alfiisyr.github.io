<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::prefix('v1')->group(function(){
  Route::post('/login',[AuthController::class,'login']);
  Route::post('/signup',[AuthController::class,'signup']);

  Route::post('/following',[FollowController::class,'following']);
  Route::post('/unfollow',[FollowController::class,'unfollow']);

  Route::post('/search',[AuthController::class,'search']);
  Route::post('/like',[LikeController::class,'like']);
  Route::post('/posting',[PostController::class,'posting']);
  Route::post('/comment',[CommentController::class,'comment']);
});
