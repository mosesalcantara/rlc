<?php

use App\Http\Controllers\Pages\PageController;
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

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminController::class, 'register_page']);
});

