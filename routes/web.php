<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('route:cache');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    // return what you want
});
Route::get('/admin', 'AuthController@index');
Route::post('/admin/login', 'AuthController@login');
Route::post('/signout', 'AuthController@signout');
Route::get('dashboard', 'DashboardController@index');
Route::get('providers', 'DashboardController@getProviders');



Route::get('dispatcher', 'DispatcherController@index');
Route::get('passengers', 'PassengerController@index');
Route::get('drivers', 'DriverController@index');
Route::get('cars', 'FleetController@index');
Route::get('passengers/getPassengersLists', 'PassengerController@getPassengersList');
Route::get('drivers/manage/{id}', 'DriverController@manage');
Route::post('drivers/all', 'DriverController@getAll');
Route::get('passengers/manage/{id}', 'PassengerController@manage');
Route::post('passengers/all', 'PassengerController@getAll');
Route::get('rates/mileage', 'RatesController@mileage');
Route::get('rates/location', 'RatesController@location');
Route::get('rates/specialdate', 'RatesController@specialdate');
Route::get('rates/customdate', 'RatesController@customdate');
Route::post('drivers/update', 'DriverController@updateDriver');
Route::get('drivers/new', 'DriverController@newDriver');
Route::post('drivers/save', 'DriverController@saveDriver');
Route::post('location/rate/new', 'RatesController@newLocationRate');
Route::post('location/rate/save', 'RatesController@saveLocationRates');
Route::post('location/rate/delete', 'RatesController@deleteLocationRates');
Route::post('passenger/update', 'PassengerController@updatePassenger');
Route::get('passengers/new', 'PassengerController@newPassenger');
Route::post('passenger/save', 'PassengerController@savePassenger');
Route::post('specialdate/rate/new', 'SpecialDatesController@newSpecialRate');
Route::post('specialdate/rate/save', 'SpecialDatesController@saveSpecialRates');
Route::post('specialdate/rate/delete', 'SpecialDatesController@deleteSpecialRates');
Route::post('mileage/rate/new', 'MileageRateController@newMileageRate');
Route::post('mileage/rate/save', 'MileageRateController@saveMileageRates');
Route::post('mileage/rate/delete', 'MileageRateController@deleteMileageRates');
Route::post('customdate/rate/new', 'CustomDateRateController@newCustomDateRate');
Route::post('customdate/rate/save', 'CustomDateRateController@saveCustomDateRates');
Route::post('customdate/rate/delete', 'CustomDateRateController@deleteCustomDateRates');
