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

// Route::get('/', function () {
//     return view('welcome');
// });
//middleware group for unauth
Route::group(['middleware' => 'employee.unauth'], function () {
    //login
    Route::get('/login','EmployeeAuthController@show')->name('login.show');

    Route::post('/login','EmployeeAuthController@login')->name('login');
});

//middleware group for employee session
Route::group(['middleware' => 'employee.session'], function () {
    //Routes or controller methods that require employee session
    Route::resource('employees', 'EmployeeController');
    //search and download
    Route::get('/post/search-and-download', [SearchController::class, 'searchAndDownload'])->name('search-and-download');
    //logout
    Route::get('/logout','EmployeeAuthController@logout')->name('logout');
});
