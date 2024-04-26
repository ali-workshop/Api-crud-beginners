<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/student', [ApiController::class,'index']);
Route::post('/student', [ApiController::class,'store']);
Route::put('/student/{id}', [ApiController::class,'update']);#see the category id case ali saleh 24/4 when use the www-xxx to fix it aram. 
Route::delete('/student/{id}', [ApiController::class,'delete']);
