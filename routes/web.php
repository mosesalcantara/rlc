<?php

use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index']);
Route::get('/for-lease', [PageController::class, 'lease']);
Route::get('/compare-properties', [PageController::class, 'properties']);
Route::get('/test', [PageController::class, 'test']);


Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register_page']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/navbar', [AdminController::class, 'navbar']);
    Route::post('/navbar/add', [AdminController::class, 'create']);
    Route::get('/navbar/edit/{id}', [AdminController::class, 'edit']);
    Route::post('/navbar/edit/{id}', [AdminController::class, 'update']);
    Route::get('/navbar/delete/{id}', [AdminController::class, 'delete']);
});

