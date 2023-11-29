<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function (){
    Route::get('/{id?}',[ProductController::class,'index']);
    Route::get('/show{id?}',[ProductController::class,'show']);
    Route::post('/store',[ProductController::class,'store']);
    Route::post('/update/{id?}',[ProductController::class,'update']);
    Route::delete('/delete/{id?}',[ProductController::class,'destroy']);
});

Route::apiResource('categories', CategoryController::class);
