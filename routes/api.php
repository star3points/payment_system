<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

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
    Route::post('cancel', 'cancel');
    Route::post('create', 'create');
});