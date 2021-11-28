<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;

// Admin Controller
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin 
Route::prefix('/admin')
    ->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');
    });
Route::post('/logout', LogoutController::class)->name('logout');