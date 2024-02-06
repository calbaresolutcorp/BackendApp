<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'sample'], function () {
    Route::get('/',[SampleController::class,'index']);
    Route::get('/{id}',[SampleController::class,'show']);
    Route::post('/',[SampleController::class,'create']);
    Route::put('/{id}',[SampleController::class,'update']);
    Route::delete('/{id}',[SampleController::class,'delete']);
});

Route::group(['prefix'=> 'product'], function () {
    Route::get('/',[ProductController::class,'index']);
    Route::get('/{id}',[ProductController::class,'show']);
    Route::post('/',[ProductController::class,'create']);
    Route::put('/{id}',[ProductController::class,'update']);
    Route::delete('/{id}',[ProductController::class,'delete']);
});