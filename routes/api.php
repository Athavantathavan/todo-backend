<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
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


 Route::post('/signup',[UserController::class, 'signup']);

 Route::middleware('auth:sanctum')->get('/sig',[UserController::class, 'getid']);

 Route::middleware('auth:sanctum')->post('/store',[TaskController::class, 'store']);

 Route::middleware('auth:sanctum')->put('/update',[TaskController::class, 'update']);


 Route::get('/getdata/{id}',[TaskController::class, 'getdata']);

 Route::middleware('auth:sanctum')->delete('/delete/{id}',[TaskController::class, 'delete']);

 Route::post('/login',[UserController::class, 'login']);

