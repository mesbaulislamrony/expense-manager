<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UtilityController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('register', 'register')->name('auth.register');
    Route::post('logout', 'logout')->name('auth.logout');
    Route::post('refresh', 'refresh')->name('auth.refresh');
});
Route::middleware('auth:api')->group(function () {
    Route::get('/me', function () {
        return response()->json(auth()->user());
    })->name('profile.me');
    
    Route::apiResource('categories', ExpenseCategoryController::class);
    Route::apiResource('expenses', ExpenseController::class);
    Route::get('/summary', [UtilityController::class, 'summary'])->name('utility.summary');
});
