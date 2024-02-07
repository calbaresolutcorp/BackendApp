<?php

use App\Http\Controllers\BarangayController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\StudentController;
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

Route::group(['prefix'=> 'company'], function () {
    Route::get('/',[CompanyController::class,'index']);
    Route::get('/{id}',[CompanyController::class,'show']);
    Route::post('/',[CompanyController::class,'create']);
    Route::put('/{id}',[CompanyController::class,'update']);
    Route::delete('/{id}',[CompanyController::class,'delete']);
});

Route::group(['prefix'=> 'department'], function () {
    Route::get('/',[DepartmentController::class,'index']);
    Route::get('/{id}',[DepartmentController::class,'show']);
    Route::post('/',[DepartmentController::class,'create']);
    Route::put('/{id}',[DepartmentController::class,'update']);
    Route::delete('/{id}',[DepartmentController::class,'delete']);
});

Route::group(['prefix'=> 'student'], function () {
    Route::get('/',[StudentController::class,'index']);
    Route::get('/{id}',[StudentController::class,'show']);
    Route::post('/',[StudentController::class,'create']);
    Route::put('/{id}',[StudentController::class,'update']);
    Route::delete('/{id}',[StudentController::class,'delete']);
});

Route::group(['prefix'=> 'barangay'], function () {
    Route::get('/',[BarangayController::class,'index']);
    Route::get('/{id}',[BarangayController::class,'show']);
    Route::post('/',[BarangayController::class,'create']);
    Route::put('/{id}',[BarangayController::class,'update']);
    Route::delete('/{id}',[BarangayController::class,'delete']);
});

