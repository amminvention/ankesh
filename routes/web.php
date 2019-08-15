<?php

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


Auth::routes(['register' => false]);
Route::match(['get', 'post'], '/', function(){
    return redirect('login');
});


Route::get('/dashboard', 'HomeController@index')->name('home');
Route::resource('sale-type', 'SaleTypeController');
Route::resource('vehicle-record', 'VehicleRecordController');
Route::resource('user', 'UserController');
Route::resource('role-permission', 'RoleController');
Route::resource('customer', 'CustomerController');

// Settings Route
Route::get('setting', 'SettingController@create')->name('setting.create');
Route::post('setting', 'SettingController@store')->name('setting.store');

// Profile Route
Route::get('profile', 'UserController@profile')->name('profile.index');
Route::post('profile', 'UserController@profileUpdate')->name('profile.update');

// Sales Report
Route::get('sales-report', 'ReportController@salesReport')->name('sales.report');
Route::get('pending-amount-report', 'ReportController@pendingReport')->name('pending.report');
Route::get('vehicle-report', 'ReportController@vehicleReport')->name('vehicle.report');
Route::get('received-amount-report', 'ReportController@receivedReport')->name('received.report');

// Import Routes
Route::get('import', 'ImportController@import')->name('import');
Route::post('import', 'ImportController@importExcel')->name('process.import');


// Global Composer Settings
View::composer('*', function ($view) {
    $view->with('set',  \App\Setting::latest()->first());
});

Route::get('command', function () {

    /* php artisan migrate */
    \Artisan::call('schedule:run');
});