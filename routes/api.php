<?php


use GoogleMaps\GoogleMaps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Google Map Location API  */
Route::get('location', function(){
    $location = new GoogleMaps();

    $response =  $location->load('geocoding')
    ->setParam([
        'address'    => 'santa cruz',
        // 'components' => [
        //     'administrative_area'  => 'TX',
        //     'country'              => 'US',
        // ]
    ])->get();
    return $response;
});

/* Admin api routes for back panel  */
Route::group(['namespace' => 'Api\Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::apiResource('/locations', LocationController::class);
    Route::apiResource('/venues', VenueController::class);
    Route::apiResource('/ceramonies', CeramonyController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/vendors', VendorController::class);
    Route::apiResource('/articles', ArticleController::class);
    Route::apiResource('/testimonials',TestimonialController::class);
});

Route::group(['namespace' => 'Api\Host', 'prefix' => 'host', 'as' => 'host.', 'middleware' => ['auth:host']], function () {
    Route::apiResource('/invitationData', InvitationDataController::class);
    Route::apiResource('/hostvenues', 'VenueController');
});


Route::group(['namespace' => 'Api\Vendor', 'prefix' => 'vendor', 'as' => 'vendor.'], function () {
    // Route::get('/vendorsProfile/{id}', 'VendorController@index');
    // Route::post('/vendorsProfile', 'VendorController@store');
    // Route::patch('/vendorsProfile/{id}', 'VendorController@update');
    // Route::post('/vendorsCProfile', 'VendorController@storeCompany');
    // Route::patch('/vendorsProfile/{id}', 'VendorController@update');
    
    // Route::get('/vendorsCategory/{id}', 'VendorController@catGet');
    Route::post('/vendorsCategory', 'VendorController@catStore');
    Route::get('/vendorsProducts/{id}/{catid}', 'VendorController@productGet');
    Route::apiResource('/review', 'ReviewController');

});


Route::group(['namespace' => 'Api\Vendor', 'prefix' => 'vendor', 'as' => 'vendor.'], function () {
   // Route::apiResource('/profile', 'ProfileController');
    Route::apiResource('/lead', 'LeadController');
});

Route::group(['namespace' => 'Api\Vendor\Services', 'prefix' => 'vendor', 'as' => 'vendor.'], function () {
    Route::apiResource('/addacc', 'AccomodationController');
    Route::apiResource('/addvenue', 'VenueController'); 
}); 


//Company Routes
Route::group(['namespace' => 'Api\Company', 'prefix' => 'company', 'as' => 'company.'], function () {
    Route::apiResource('/profile', 'ProfileController');

});

//Host Routes
Route::group(['namespace' => 'Api\Host', 'prefix' => 'host', 'as' => 'host.'], function () {
    Route::apiResource('/profile', 'ProfileController');

});

//Bride Routes
Route::group(['namespace' => 'Api\Bride', 'prefix' => 'bride', 'as' => 'bride.'], function () {
    Route::apiResource('/profile', 'ProfileController');

});


//Groom Routes
Route::group(['namespace' => 'Api\Groom', 'prefix' => 'groom', 'as' => 'groom.'], function () {
    Route::apiResource('/profile', 'ProfileController');

});


//Guest Routes
Route::group(['namespace' => 'Api\Guest', 'prefix' => 'guest', 'as' => 'guest.'], function () {
    Route::apiResource('/profile', 'ProfileController');

});

Route::group(['namespace' => 'Api'], function () {
    Route::apiResource('contactus', 'ContactusController');
    Route::apiResource('sitetasks', 'SitetasksController');
    //Route::apiResource('authcheck', 'AuthcheckController');

});

Route::group([ 'namespace' => 'Api'], function () {
    Route::apiResource('authcheck', 'AuthcheckController');
});

// Host City Routes
Route::prefix('host')->middleware(['auth:host'])->group(function () {
    Route::post('/cities', [App\Http\Controllers\Api\Host\CityController::class, 'store']);
    Route::put('/cities/{id}', [App\Http\Controllers\Api\Host\CityController::class, 'update']);
});

// Admin route to sync cities
Route::prefix('admin')->group(function () {
    Route::get('/sync-cities', [App\Http\Controllers\Api\Host\CityController::class, 'syncCities']);
    Route::get('/states', [App\Http\Controllers\Api\Admin\LocationController::class, 'getStates']);
    Route::get('/cities/{stateId}', [App\Http\Controllers\Api\Admin\LocationController::class, 'getCitiesByState']);
});

// Public routes for location data
Route::get('/states', [App\Http\Controllers\Api\Admin\LocationController::class, 'getStates']);
Route::get('/cities/{stateId}', [App\Http\Controllers\Api\Admin\LocationController::class, 'getCitiesByState']);
Route::get('/venues/by-city/{cityId}', [App\Http\Controllers\Api\Admin\VenueController::class, 'getVenuesByCity']);

