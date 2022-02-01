<?php
namespace App\Http\Controllers;

use App\Http\Controllers\VerifyUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/* Grupo de Rotas que obriga o usuario estar logado */
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('/verify/{urlId}', [VerifyUrlController::class, 'show']);
    Route::post('/verify', [VerifyUrlController::class, 'store']);
    Route::put('/verify/{urlId}', [VerifyUrlController::class, 'update']);
    Route::delete('/verify/{urlId}', [VerifyUrlController::class, 'destroy']);
});
