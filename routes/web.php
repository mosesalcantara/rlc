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
use App\Models\Snapshot;
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
Route::get('/unit', [PageController::class, 'unit']);
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
});

Route::prefix('admin/properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index']);
    Route::post('/', [PropertyController::class, 'get_all']);
    Route::post('/add', [PropertyController::class, 'create']);
    Route::post('/edit', [PropertyController::class, 'edit']);
    Route::post('/update', [PropertyController::class, 'update']);
    Route::post('/delete', [PropertyController::class, 'delete']);
});

Route::prefix('admin/amenities')->group(function () {
    Route::get('/', [AmenityController::class, 'index']);
    Route::post('/', [AmenityController::class, 'get_all']);
    Route::post('/add', [AmenityController::class, 'create']);
    Route::post('/edit', [AmenityController::class, 'edit']);
    Route::post('/update', [AmenityController::class, 'update']);
    Route::post('/delete', [AmenityController::class, 'delete']);
});

Route::prefix('admin/residential')->group(function () {
    Route::get('/', [ResidentialUnitController::class, 'index']);
    Route::post('/', [ResidentialUnitController::class, 'get_all']);
    Route::post('/get-related', [ResidentialUnitController::class, 'get_related']);
    Route::post('/add', [ResidentialUnitController::class, 'create']);
    Route::post('/edit', [ResidentialUnitController::class, 'edit']);
    Route::post('/update', [ResidentialUnitController::class, 'update']);
    Route::post('/delete', [ResidentialUnitController::class, 'delete']);

    Route::get('/test', [ResidentialUnitController::class, 'test']);
});

Route::prefix('admin/commercial')->group(function () {
    Route::get('/', [CommercialUnitController::class, 'index']);
    Route::post('/', [CommercialUnitController::class, 'get_all']);
    Route::post('/add', [CommercialUnitController::class, 'create']);
    Route::post('/edit', [CommercialUnitController::class, 'edit']);
    Route::post('/update', [CommercialUnitController::class, 'update']);
    Route::post('/delete', [CommercialUnitController::class, 'delete']);
});

Route::prefix('admin/parking')->group(function () {
    Route::get('/', [ParkingSlotController::class, 'index']);
    Route::post('/', [ParkingSlotController::class, 'get_all']);
    Route::post('/add', [ParkingSlotController::class, 'create']);
    Route::post('/edit', [ParkingSlotController::class, 'edit']);
    Route::post('/update', [ParkingSlotController::class, 'update']);
    Route::post('/delete', [ParkingSlotController::class, 'delete']);
});

Route::prefix('admin/videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::post('/', [VideoController::class, 'get_all']);
    Route::post('/add', [VideoController::class, 'create']);
    Route::post('/edit', [VideoController::class, 'edit']);
    Route::post('/update', [VideoController::class, 'update']);
    Route::post('/delete', [VideoController::class, 'delete']);
});

Route::prefix('admin/snapshots')->group(function () {
    Route::get('/', [SnapshotController::class, 'index']);
    Route::post('/', [SnapshotController::class, 'get_all']);
    Route::post('/get-related', [SnapshotController::class, 'get_related']);
    Route::post('/add', [SnapshotController::class, 'create']);
    Route::post('/edit', [SnapshotController::class, 'edit']);
    Route::post('/update', [SnapshotController::class, 'update']);
    Route::post('/delete', [SnapshotController::class, 'delete']);
});

Route::prefix('admin/snapshots')->group(function () {

});
