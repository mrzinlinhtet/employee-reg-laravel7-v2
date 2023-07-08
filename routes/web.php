<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\EmployeeController;
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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::group(['middleware' => 'employee.unauth'], function () {
    //login
    Route::get('/', 'EmployeeAuthController@show')->name('login.show');
    Route::get('/login', 'EmployeeAuthController@show')->name('login.show');
    Route::post('/login', 'EmployeeAuthController@login')->name('login');
    //forgotPassword
    Route::get('/forgot-password-form', 'ForgotPasswordMailController@getForgotForm')->name('forgot-password');
    Route::post('/forgot-password-form', 'ForgotPasswordMailController@postForgotForm')->name('forgot-password');
    //changePassword
    Route::get('/change-password-form', 'ForgotPasswordMailController@getChangePasswordForm')->name('change-password');
    Route::post('/change-password-form', 'ForgotPasswordMailController@postChangePasswordForm')->name('change-password');
    //verifyOTP
    Route::get('/verify-otp-form', 'ForgotPasswordMailController@getVerifyOTPForm')->name('verify-otp');
    Route::post('/verify-otp-form', 'ForgotPasswordMailController@postVerifyOTPForm')->name('verify-otp');
});

//Routes or controller methods that require employee session
Route::group(['middleware' => 'employee.session'], function () {
    //call all function from EmployeeController with resource
    Route::resource('employees', 'EmployeeController');
    //search and download excel
    Route::get('employees-search-download-excel', 'DownloadController@exportExcel')->name('search-download-excel');
    //search and download pdf
    Route::get('employees-search-download-pdf', 'DownloadController@downloadPDF')->name('search-download-pdf');
    //export excel format
    Route::get('reg-export', 'ExcelExportImportController@export')->name('reg-export');
    //import excel to register multi employee
    Route::post('reg-import', 'ExcelExportImportController@import')->name('reg-import');
    //active and inactive stage
    Route::patch('employees/inactive/{id}', 'EmployeeController@softDelete')->name('emp-inactive');
    Route::patch('employees/active/{id}', 'EmployeeController@restore')->name('emp-active');
    //change language
    Route::get('language/{locale}', 'LocalizationController@setLang');
    //logout
    Route::get('logout', 'EmployeeAuthController@logout')->name('logout');
});
