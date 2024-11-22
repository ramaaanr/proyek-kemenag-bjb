<?php

use App\Http\Controllers\PernikahanController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users/login', [UserController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/users/logout', [UserController::class, 'logout']);
});
Route::get('/pernikahan', [PernikahanController::class, 'index']);
Route::get('/pernikahan/{id}', [PernikahanController::class, 'show']);
Route::post('/pernikahan', [PernikahanController::class, 'store']);
Route::delete('/pernikahan/{id}', [PernikahanController::class, 'destroy']);
Route::patch('/pernikahan/{id}', [PernikahanController::class, 'update']);