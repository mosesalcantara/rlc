<?php

use App\Http\Controllers\Pages\PageController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\ResidentialUnitController;
use App\Http\Controllers\Admin\CommercialUnitController;
use App\Http\Controllers\Admin\ParkingSlotController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SnapshotController;

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
Route::get('/for-lease/category/{category}', [PageController::class, 'category']);
Route::get('/compare-properties', [PageController::class, 'properties']);
Route::get('/contact-us', [PageController::class, 'contact']);
Route::get('/about-us', [PageController::class, 'about']);
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

Route::prefix('admin/properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index']);
    Route::get('/add', [PropertyController::class, 'add']);
    Route::post('/add', [PropertyController::class, 'create']);
    Route::get('/edit/{id}', [PropertyController::class, 'edit']);
    Route::post('/edit/{id}', [PropertyController::class, 'update']);
    Route::get('/delete/{id}', [PropertyController::class, 'delete']);
});

Route::prefix('admin/amenities')->group(function () {
    Route::get('/', [AmenityController::class, 'index']);
    Route::get('/add', [AmenityController::class, 'add']);
    Route::post('/add', [AmenityController::class, 'create']);
    Route::get('/edit/{id}', [AmenityController::class, 'edit']);
    Route::post('/edit/{id}', [AmenityController::class, 'update']);
    Route::get('/delete/{id}', [AmenityController::class, 'delete']);
});

Route::prefix('admin/residential')->group(function () {
    Route::get('/', [ResidentialUnitController::class, 'index']);
    Route::get('/add', [ResidentialUnitController::class, 'add']);
    Route::post('/add', [ResidentialUnitController::class, 'create']);
    Route::get('/edit/{id}', [ResidentialUnitController::class, 'edit']);
    Route::post('/edit/{id}', [ResidentialUnitController::class, 'update']);
    Route::get('/delete/{id}', [ResidentialUnitController::class, 'delete']);

    Route::get('/test', [ResidentialUnitController::class, 'test']);
});

Route::prefix('admin/commercial')->group(function () {
    Route::get('/', [CommercialUnitController::class, 'index']);
    Route::get('/add', [CommercialUnitController::class, 'add']);
    Route::post('/add', [CommercialUnitController::class, 'create']);
    Route::get('/edit/{id}', [CommercialUnitController::class, 'edit']);
    Route::post('/edit/{id}', [CommercialUnitController::class, 'update']);
    Route::get('/delete/{id}', [CommercialUnitController::class, 'delete']);
});

Route::prefix('admin/parking')->group(function () {
    Route::get('/', [ParkingSlotController::class, 'index']);
    Route::get('/add', [ParkingSlotController::class, 'add']);
    Route::post('/add', [ParkingSlotController::class, 'create']);
    Route::get('/edit/{id}', [ParkingSlotController::class, 'edit']);
    Route::post('/edit/{id}', [ParkingSlotController::class, 'update']);
    Route::get('/delete/{id}', [ParkingSlotController::class, 'delete']);
});

Route::prefix('admin/videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::get('/add', [VideoController::class, 'add']);
    Route::post('/add', [VideoController::class, 'create']);
    Route::get('/edit/{id}', [VideoController::class, 'edit']);
    Route::post('/edit/{id}', [VideoController::class, 'update']);
    Route::get('/delete/{id}', [VideoController::class, 'delete']);
});

Route::prefix('admin/snapshots')->group(function () {
    Route::get('/', [SnapshotController::class, 'index']);
    Route::get('/add', [SnapshotController::class, 'add']);
    Route::post('/add', [SnapshotController::class, 'create']);
    Route::get('/edit/{id}', [SnapshotController::class, 'edit']);
    Route::post('/edit/{id}', [SnapshotController::class, 'update']);
    Route::get('/delete/{id}', [SnapshotController::class, 'delete']);
});
