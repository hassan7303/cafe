<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    // Route::post('/login', [UserController::class, 'login']);
    Route::group(['prefix' => 'users'], function () {    
        Route::get('/', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'insert']);
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'delete']);
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'insert']);
        Route::put('/', [ProductController::class, 'update']);
        Route::delete('/', [ProductController::class, 'delete']);
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'insert']);
        Route::put('/', [CategoryController::class, 'update']);
        Route::delete('/', [CategoryController::class, 'delete']);
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'insert']);
        Route::put('/', [OrderController::class, 'update']);
        Route::delete('/', [OrderController::class, 'delete']);
    });
});