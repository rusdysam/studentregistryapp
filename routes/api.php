<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Student;

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

Route::get('/student',[StudentController::class,'index']);

Route::post('/student',[StudentController::class,'upload']);

Route::put('/student/edit/{id}',[StudentController::class,'edit']);

Route::delete('/student/edit/{id}',[StudentController::class,'delete']);

Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', [UserController::class,'user']);
    
});

Route::get('/student/search', [StudentController::class,'search']);