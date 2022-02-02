<?php

use Illuminate\Support\Facades\Route;
use App\Models\VerifyUrl;
use App\Models\Url;
use App\Http\Controllers\VerifyUrlController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $data = collect(VerifyUrl::get()->all())->toArray();
    $urls = collect(Url::get()->where('user_id', '=', auth()->user()->id))->toArray();
    return view('dashboard', $data)->with(['data' => $data, 'urls'=> $urls]);
})->name('dashboard');

Route::middleware('auth:sanctum')->post('/verify', [VerifyUrlController::class, 'store']);
Route::middleware('auth:sanctum')->put('/verify/{urlId}', [VerifyUrlController::class, 'update']);
Route::middleware('auth:sanctum')->delete('verify/{urlId}', [VerifyUrlController::class, 'destroy']);
