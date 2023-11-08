<?php

use App\Http\Controllers\API\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // User domain routes
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    //    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');

});
