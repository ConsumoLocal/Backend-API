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

Route::group(['middleware' => 'auth:api'], function () {

});


Route::post('register', 'Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout');


// BUSINESS
Route::apiResource('business', 'BusinessController');
Route::get('business/status/{status}', 'BusinessController@showAllWithStatus');
Route::post('business/image/upload', 'BusinessController@uploadImage');
Route::get('business/{business}/image', 'BusinessController@getImage');

// Cities
Route::apiResource('city', 'CityController');

Route::get('city/{id}/businesses', 'CityController@getBusinesses');

// Categories

Route::apiResource('category', 'CategoryController');
Route::post('category/businesses', 'CategoryController@business');

// User
Route::get('user/{id}/businesses', 'UserController@getBusinesses');
Route::post('user/password/recover', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// Links

Route::apiResource('link', 'LinkController');

Route::get('link/{id}/image', 'LinkController@getImage');
