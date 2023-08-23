<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('/items')->group(function(){
    Route::get('/index/{userID}', [ItemController::class, 'index']);
    Route::post('/create/{userID}', [ItemController::class, 'create']);
    Route::put('/update/{userId}/{itemID}', [ItemController::class, 'update']);
    Route::delete('/delete/{userId}/{itemID}', [ItemController::class, 'delete']);
});
