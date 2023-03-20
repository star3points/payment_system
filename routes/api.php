<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'controller' => AuthController::class,
    'prefix' => 'auth'
], function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('me', 'me');
    });
});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::group([
        'controller' => \App\Http\Controllers\UserController::class,
        'prefix' => 'user'
    ], function () {
        Route::get('index', 'index');
        Route::post('register', 'register');
        Route::post('status', 'setStatus');
    });

    Route::group([
        'controller' => \App\Http\Controllers\TransactionController::class,
        'prefix' => 'transaction'
    ], function () {
        Route::get('index', 'index');
        Route::post('create', 'create');
        Route::post('handle', 'handle');
        Route::post('cancel', 'cancel');
    });
});
