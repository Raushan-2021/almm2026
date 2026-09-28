<?php

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

//|-------------------------------with AuthCheck----------------------------------------------
Route::prefix('v1/inspector')->namespace('Api')->middleware('AuthCheck')->group(function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('get-meta-data','GeneralController@getMetaData');
    Route::post('get-profile', 'InspectorController@getProfile');
    Route::post('get-inspection-list','InspectorController@getInspectionList');
    Route::post('get-inspection-detail','InspectorController@getInspectionDetail');
    Route::post('update-inspection-details','InspectorController@updateInspectionDetail');
});
//|-------------------------------with AuthCheck----------------------------------------------
Route::prefix('v1/installer')->namespace('Api')->middleware('AuthCheck')->group(function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('get-meta-data','GeneralController@getMetaData');
    Route::post('get-profile', 'InstallerController@getProfile');
    Route::post('add-consumer-interest-form','InstallerController@consumerIntrestForm');
    Route::post('get-installation-list','InstallerController@getInstallationList');
    Route::post('get-installation-details', 'InstallerController@getInstallationDetail');
    Route::post('update-installation-datails', 'InstallerController@updateInstallationDetail');
    Route::post('get-maintenance-list', 'InstallerController@getMaintenanceList');
    Route::post('get-maintenance-details','InstallerController@getMaintenanceDetail');
    Route::post('update-maintenance-details','InstallerController@updateMaintenanceDetails');
});
//|---------------------------------General APIs----------------------------------------------
Route::prefix('v1')->namespace('Api')->group(function () {
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('installer/login', 'AuthController@login');
    Route::post('inspector/login', 'AuthController@login');
});

Route::prefix('v1')->namespace('Api')->middleware('AuthCheck')->group(function () {
    Route::get('get-document/{consumerId}/{folder}/{filename}/{maintenanceRegistryCode?}','GeneralController@getDocument');
    Route::get('get-public-image/{filepath}','GeneralController@getImages');
});

Route::prefix('v1')->group(function () {
    Route::any('{route}/{param?}', function(){
        return response()->json(['success' => 0, 'msg' => 'Invalid Endpoint!', 'result' => []], 404);
    });
});