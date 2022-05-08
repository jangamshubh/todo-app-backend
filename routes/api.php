<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TodoController;
use App\Http\Controllers\API\DashboardController;
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

Route::group([ 'middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([ 'middleware' => 'api', 'prefix' => 'todos'], function ($router) {
    Route::get('/', [TodoController::class, 'index']);
    Route::post('/store',[TodoController::class, 'store']);
    Route::get('/{id}/edit',[TodoController::class, 'edit']);
    Route::put('/{id}/update', [TodoController::class, 'update']);
    Route::get('/{id}/delete', [TodoController::class, 'delete']);
    Route::get('/{id}/show', [TodoController::class, 'show']);
});

Route::get('dashboard',[DashboardController::class, 'index']);
