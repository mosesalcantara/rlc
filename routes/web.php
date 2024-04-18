<?php

use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Pages\SaleController;
use App\Http\Controllers\Pages\LeaseController;
use App\Http\Controllers\Pages\CompareController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\BuildingController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\ResidentialUnitController;
use App\Http\Controllers\Admin\SnapshotController;
use App\Http\Controllers\Admin\UnitVideoController;
use App\Http\Controllers\Admin\CommercialUnitController;
use App\Http\Controllers\Admin\ParkingSlotController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\ContactItemController;
use App\Http\Controllers\Admin\InquiryEmailController;
use App\Http\Controllers\Admin\ViewingController;
use App\Http\Controllers\Admin\RegisteredUnitController;
use App\Http\Controllers\Admin\AboutItemController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Pages\BotManController;

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

Route::match(['get', 'post'], '/botman', [BotManController::class, 'botman']);

Route::get('/', [PageController::class, 'index']);
Route::post('/get-settings', [PageController::class, 'get_settings']);

Route::get('/contact-us', [PageController::class, 'contact']);
Route::post('/contact-us', [PageController::class, 'send_inquiry']);
Route::post('/request-viewing', [PageController::class, 'request_viewing']);
Route::get('/submit-review', [PageController::class, 'submit_review']);
Route::post('/submit-review', [PageController::class, 'save_review']);
Route::get('/unit-registration', [PageController::class, 'unit_registration']);
Route::post('/unit-registration', [PageController::class, 'register_unit']);
Route::post('/unit-registration/related-buildings', [PageController::class, 'related_buildings']);

Route::get('/about-us', [PageController::class, 'about']);

Route::get('/calculator', [PageController::class, 'calculator']);

Route::get('/test', [PageController::class, 'test']);

Route::get('/for-sale', [SaleController::class, 'sale']);

Route::get('/for-sale/category/{sale_status}', [SaleController::class, 'units']);
Route::get('/for-sale/category/{sale_status}/{id}', [SaleController::class, 'unit']);
Route::get('/for-sale/property/{id}', [SaleController::class, 'property']);

Route::post('/for-sale/search', [SaleController::class, 'search']);
Route::post('/for-sale/get-filters', [SaleController::class, 'get_filters']);

Route::get('/for-lease', [LeaseController::class, 'lease']);

Route::get('/for-lease/category/residential_units', [LeaseController::class, 'residential_units']);
Route::get('/for-lease/category/commercial_units', [LeaseController::class, 'commercial_units']);
Route::get('/for-lease/category/parking_slots', [LeaseController::class, 'parking_slots']);

Route::post('/for-lease/category/residential_units', [LeaseController::class, 'search_residential_units']);
Route::post('/for-lease/category/commercial_units', [LeaseController::class, 'search_commercial_units']);
Route::post('/for-lease/category/parking_slots', [LeaseController::class, 'search_parking_slots']);

Route::get('/for-lease/category/residential_units/{id}', [LeaseController::class, 'residential_unit']);
Route::get('/for-lease/category/commercial_units/{id}', [LeaseController::class, 'commercial_unit']);
Route::get('/for-lease/category/parking_slots/{id}', [LeaseController::class, 'parking_slot']);

Route::get('/for-lease/property/{id}', [LeaseController::class, 'property']);

Route::post('/for-lease/get-filters', [LeaseController::class, 'get_filters']);
Route::post('/for-lease/get-properties', [LeaseController::class, 'get_properties']);

Route::get('/compare', [CompareController::class, 'properties']);

Route::post('/compare/get-residential-units', [CompareController::class, 'get_residential_units']);
Route::post('/compare/get-commercial-units', [CompareController::class, 'get_commercial_units']);

Route::post('/compare/residential-properties', [CompareController::class, 'compare_residential_properties']);
Route::post('/compare/commercial-properties', [CompareController::class, 'compare_commercial_properties']);

Route::post('/compare/residential-units', [CompareController::class, 'compare_residential_units']);
Route::post('/compare/commercial-units', [CompareController::class, 'compare_commercial_units']);

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

Route::prefix('admin/videos')->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::post('/', [VideoController::class, 'get_all']);
    Route::post('/add', [VideoController::class, 'create']);
    Route::post('/edit', [VideoController::class, 'edit']);
    Route::post('/update', [VideoController::class, 'update']);
    Route::post('/delete', [VideoController::class, 'delete']);
});


Route::prefix('admin/reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/', [ReviewController::class, 'get_all']);
    Route::post('/get-related', [ReviewController::class, 'get_related']);
    Route::post('/add', [ReviewController::class, 'create']);
    Route::post('/edit', [ReviewController::class, 'edit']);
    Route::post('/update', [ReviewController::class, 'update']);
    Route::post('/delete', [ReviewController::class, 'delete']);
});

Route::prefix('admin/properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index']);
    Route::post('/', [PropertyController::class, 'get_all']);
    Route::post('/add', [PropertyController::class, 'create']);
    Route::post('/edit', [PropertyController::class, 'edit']);
    Route::post('/update', [PropertyController::class, 'update']);
    Route::post('/delete', [PropertyController::class, 'delete']);
});

Route::prefix('admin/buildings')->group(function () {
    Route::get('/', [BuildingController::class, 'index']);
    Route::post('/', [BuildingController::class, 'get_all']);
    Route::post('/get-related', [BuildingController::class, 'get_related']);
    Route::post('/add', [BuildingController::class, 'create']);
    Route::post('/edit', [BuildingController::class, 'edit']);
    Route::post('/update', [BuildingController::class, 'update']);
    Route::post('/delete', [BuildingController::class, 'delete']);
});

Route::prefix('admin/pictures')->group(function () {
    Route::get('/', [PictureController::class, 'index']);
    Route::post('/', [PictureController::class, 'get_all']);
    Route::post('/get-related', [PictureController::class, 'get_related']);
    Route::post('/add', [PictureController::class, 'create']);
    Route::post('/edit', [PictureController::class, 'edit']);
    Route::post('/update', [PictureController::class, 'update']);
    Route::post('/delete', [PictureController::class, 'delete']);
});

Route::prefix('admin/amenities')->group(function () {
    Route::get('/', [AmenityController::class, 'index']);
    Route::post('/', [AmenityController::class, 'get_all']);
    Route::post('/get-related', [AmenityController::class, 'get_related']);
    Route::post('/add', [AmenityController::class, 'create']);
    Route::post('/edit', [AmenityController::class, 'edit']);
    Route::post('/update', [AmenityController::class, 'update']);
    Route::post('/delete', [AmenityController::class, 'delete']);
});

Route::prefix('admin/residential')->group(function () {
    Route::get('/', [ResidentialUnitController::class, 'index']);
    Route::post('/', [ResidentialUnitController::class, 'get_all']);
    Route::post('/related-properties', [ResidentialUnitController::class, 'related_properties']);
    Route::post('/related-buildings', [ResidentialUnitController::class, 'related_buildings']);
    Route::post('/add', [ResidentialUnitController::class, 'create']);
    Route::post('/edit', [ResidentialUnitController::class, 'edit']);
    Route::post('/update', [ResidentialUnitController::class, 'update']);
    Route::post('/delete', [ResidentialUnitController::class, 'delete']);
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

Route::prefix('admin/unit_videos')->group(function () {
    Route::get('/', [UnitVideoController::class, 'index']);
    Route::post('/', [UnitVideoController::class, 'get_all']);
    Route::post('/get-related', [UnitVideoController::class, 'get_related']);
    Route::post('/add', [UnitVideoController::class, 'create']);
    Route::post('/edit', [UnitVideoController::class, 'edit']);
    Route::post('/update', [UnitVideoController::class, 'update']);
    Route::post('/delete', [UnitVideoController::class, 'delete']);
});

Route::prefix('admin/commercial')->group(function () {
    Route::get('/', [CommercialUnitController::class, 'index']);
    Route::post('/', [CommercialUnitController::class, 'get_all']);
    Route::post('/related-properties', [CommercialUnitController::class, 'related_properties']);
    Route::post('/related-buildings', [CommercialUnitController::class, 'related_buildings']);
    Route::post('/add', [CommercialUnitController::class, 'create']);
    Route::post('/edit', [CommercialUnitController::class, 'edit']);
    Route::post('/update', [CommercialUnitController::class, 'update']);
    Route::post('/delete', [CommercialUnitController::class, 'delete']);
});

Route::prefix('admin/parking')->group(function () {
    Route::get('/', [ParkingSlotController::class, 'index']);
    Route::post('/', [ParkingSlotController::class, 'get_all']);
    Route::post('/get-related', [ParkingSlotController::class, 'get_related']);
    Route::post('/add', [ParkingSlotController::class, 'create']);
    Route::post('/edit', [ParkingSlotController::class, 'edit']);
    Route::post('/update', [ParkingSlotController::class, 'update']);
    Route::post('/delete', [ParkingSlotController::class, 'delete']);
});

Route::prefix('admin/terms')->group(function () {
    Route::get('/', [TermController::class, 'index']);
    Route::post('/', [TermController::class, 'get_all']);
    Route::post('/get-related', [TermController::class, 'get_related']);
    Route::post('/add', [TermController::class, 'create']);
    Route::post('/edit', [TermController::class, 'edit']);
    Route::post('/update', [TermController::class, 'update']);
    Route::post('/delete', [TermController::class, 'delete']);
});

Route::prefix('admin/contact')->group(function () {
    Route::get('/', [ContactItemController::class, 'index']);
    Route::post('/edit', [ContactItemController::class, 'edit']);
    Route::post('/update', [ContactItemController::class, 'update']);
});

Route::prefix('admin/inquiry_emails')->group(function () {
    Route::get('/', [InquiryEmailController::class, 'index']);
    Route::post('/', [InquiryEmailController::class, 'get_all']);
    Route::post('/add', [InquiryEmailController::class, 'create']);
    Route::post('/edit', [InquiryEmailController::class, 'edit']);
    Route::post('/update', [InquiryEmailController::class, 'update']);
    Route::post('/delete', [InquiryEmailController::class, 'delete']);
});

Route::prefix('admin/viewings')->group(function () {
    Route::get('/', [ViewingController::class, 'index']);
    Route::post('/', [ViewingController::class, 'get_all']);
    Route::post('/add', [ViewingController::class, 'create']);
    Route::post('/edit', [ViewingController::class, 'edit']);
    Route::post('/update', [ViewingController::class, 'update']);
    Route::post('/delete', [ViewingController::class, 'delete']);
});

Route::prefix('admin/registered_units')->group(function () {
    Route::get('/', [RegisteredUnitController::class, 'index']);
    Route::post('/', [RegisteredUnitController::class, 'get_all']);
    Route::post('/get-related', [RegisteredUnitController::class, 'get_related']);
    Route::post('/add', [RegisteredUnitController::class, 'create']);
    Route::post('/edit', [RegisteredUnitController::class, 'edit']);
    Route::post('/update', [RegisteredUnitController::class, 'update']);
    Route::post('/delete', [RegisteredUnitController::class, 'delete']);
});

Route::prefix('admin/about')->group(function () {
    Route::get('/', [AboutItemController::class, 'index']);
    Route::post('/edit', [AboutItemController::class, 'edit']);
    Route::post('/update', [AboutItemController::class, 'update']);
});

Route::prefix('admin/articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/', [ArticleController::class, 'get_all']);
    Route::post('/get-related', [ArticleController::class, 'get_related']);
    Route::post('/add', [ArticleController::class, 'create']);
    Route::post('/edit', [ArticleController::class, 'edit']);
    Route::post('/update', [ArticleController::class, 'update']);
    Route::post('/delete', [ArticleController::class, 'delete']);
});

Route::prefix('admin/settings')->group(function () {
    Route::get('/', [SettingController::class, 'index']);
    Route::post('/edit', [SettingController::class, 'edit']);
    Route::post('/update', [SettingController::class, 'update']);
});
