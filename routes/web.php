<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerPackagesController;
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


//KW - routes controler which page is shown when users visit a specific page.
Route::get('/', 'App\Http\Controllers\PagesController@index');//KW Route to homepage of application.

Route::get('/about', 'App\Http\Controllers\PagesController@about');//KW Route to about pafe of application.

Route::get('/services', 'App\Http\Controllers\PagesController@services');//KW Route to services page of application.

Route::get('/show-pdf/{id}','App\Http\Controllers\PagesController@viewpdf');


Route::get('/managepackages/create/{id}','App\Http\Controllers\ManagePackagesTest@create');
// Route::get('/managepackages/store/{id}','App\Http\Controllers\ManagePackagesTest@store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Kw - creating a route for each function that exists in the CustomerPackagesController
Route::resource('customerpackage','App\Http\Controllers\CustomerPackagesController');//KW full path name is needed.
Route::resource('managepackages','App\Http\Controllers\ManagePackagesController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


