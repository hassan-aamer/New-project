<?php

use Illuminate\Support\Facades\Route;

//========================================================== Auth ==============================================================
Route::group(['prefix' => 'auth'], function () {
    Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
        Route::post('/register', 'createUser');
        Route::post('/login', 'loginUser');
        Route::post('/logout', 'logout');
        Route::post('/update/{id}', 'update')->middleware('auth:sanctum');
        Route::get('/users', 'allUsers')->middleware('auth:sanctum');
        Route::delete('/delete/{id}', 'delete')->middleware('auth:sanctum');
        Route::get('/show/{id}', 'show')->middleware('auth:sanctum');
    });
});
//==============================================================================================================================

Route::middleware('auth:sanctum')->group(function () {

    //========================================================= Contact ========================================================

    Route::group(['prefix' => 'contact'], function () {
        Route::controller(\App\Http\Controllers\Api\Contact\ContactController::class)->group(function () {
            Route::post('/update/{id}', 'update');
            Route::get('/show/{id}', 'show');
        });
    });

    //=========================================================== About ========================================================

    Route::group(['prefix' => 'about'], function () {
        Route::controller(\App\Http\Controllers\Api\About\AboutController::class)->group(function () {
            Route::post('/update/{id}', 'update');
            Route::get('/show/{id}', 'show');
        });
    });










});
