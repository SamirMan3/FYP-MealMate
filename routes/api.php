<?php

use App\Http\Controllers\Api\AuthController;
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
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/getProfile', [AuthController::class, 'getProfile']);
Route::get('/getDoctor/{id}', [AuthController::class, 'getDoctor']);
Route::get('/getProductList', [AuthController::class, 'getProductList']);
Route::post('/user/register', [AuthController::class, 'userRegister']);
Route::post('/user/login', [AuthController::class, 'userLogin']);
Route::post('/doctor/requestDiet', [AuthController::class, 'requestDiet']);
Route::post('/user/logout', [AuthController::class, 'userLogout']);
