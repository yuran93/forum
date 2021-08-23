<?php

use App\Http\Controllers\ApprovedPostsController;
use App\Http\Controllers\PendingPostsController;
use App\Http\Controllers\ApprovePostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MyPostsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function() {

    Route::apiResource('comments', CommentsController::class);
    Route::apiResource('posts', PostsController::class);

    Route::get('my-posts', MyPostsController::class);
    Route::get('pending-posts', PendingPostsController::class);
    Route::get('approved-posts', ApprovedPostsController::class);
    Route::post('posts/{id}/approve', ApprovePostController::class);

});
