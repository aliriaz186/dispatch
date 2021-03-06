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
Route::get('/', 'AuthController@index');
Route::post('/admin/login', 'AuthController@login');
Route::post('/signout', 'AuthController@signout');
Route::get('dashboard', 'DashboardController@index');
Route::get('technicians', 'TechnicianController@getView');
Route::post('technicians/all', 'TechnicianController@getAll');
Route::get('technicians/new', 'TechnicianController@newTechnicianView');
Route::post('technician/save', 'TechnicianController@saveTechnician');
Route::get('technicians/manage/{id}', 'TechnicianController@manageTechnician');
Route::get('technicians/delete/{id}', 'TechnicianController@deleteTechnician');
Route::post('technicians/update', 'TechnicianController@updateTechnician');
Route::get('jobs', 'JobsController@getView');
Route::post('jobs/all', 'JobsController@getAll');
Route::get('jobs/new', 'JobsController@newJobView');
Route::post('job/save', 'JobsController@saveJob');
Route::get('customers', 'CustomerController@getView');
Route::post('customers/all', 'CustomerController@getAll');
Route::get('customers/manage/{id}', 'CustomerController@manage');
Route::post('customer/update', 'CustomerController@update');
Route::get('jobs/{id}/details', 'JobsController@getJobDetails');
Route::get('technicians/{id}/details', 'TechnicianController@getTechnicianDetails');
Route::get('technicians/{id}/jobs/new', 'TechnicianController@addNewJob');
Route::post('forgot-password-request', 'AuthController@forgotPasswordRequest');
Route::get('set-password/{email}/get', 'AuthController@setPasswordPage');
Route::post('forgot-password-change', 'AuthController@changePassword');
Route::post('technician/files/save', 'TechnicianController@saveFiles');
Route::get('new-job', 'JobsController@newJobView');
Route::post('job/images/save', 'JobsController@saveImages');
Route::post('followup/claim/denied', 'JobsController@denyFollowUpClaim');
Route::post('followup/claim/approve', 'JobsController@approveFollowUpClaim');
Route::post('claim/status/change', 'JobsController@changeStatusClaim');
Route::post('cap/all', 'CapController@getAllCap');
Route::get('cap', 'CapController@getView');
Route::get('cap/new', 'CapController@newCapView');
Route::post('cap/save', 'CapController@saveCap');
Route::get('customer/{id}/details', 'CustomerController@getCustomerDetails');
Route::post('cap/amount/add', 'CapController@addCapAmount');
Route::get('reviews', 'ReviewController@getView');
Route::get('caps/manage/{id}', 'CapController@manage');
Route::post('cap/update', 'CapController@update');
Route::get('caps/delete/{id}', 'CapController@deleteCap');
Route::post('change/claim/technician', 'TechnicianController@changeTechnician');
Route::post('get-provider-against-zip-code', 'TechnicianController@getProviderAgainstZipCode');
Route::get('invoices', 'InvoiceController@getInvoices');
Route::get('invoice-mark-as-paid/{id}', 'InvoiceController@changeStatus');


