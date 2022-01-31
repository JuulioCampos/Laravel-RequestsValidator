<?php
namespace App\Http\Controllers;

use App\Http\Controllers\VerifyUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/verify', [VerifyUrlController::class, "index"]);
Route::get('/verify/{urlId}', [VerifyUrlController::class, 'show']);
Route::post('/verify', [VerifyUrlController::class, 'store']);
Route::put('/verify/{urlId}', [VerifyUrlController::class, 'update']);

