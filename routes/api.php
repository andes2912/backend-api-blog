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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/// Authentication \\\
  Route::post('login','API\Auth\LoginController@index'); // Login
  Route::post('register','API\Auth\RegisterController@index'); // Register
  Route::post('logout','API\Auth\LoginController@logout'); // Logout
  Route::get('me','API\Account\MeController@index')->middleware('auth:api'); // Me
  Route::put('update-profile/{id}','API\Account\MeController@update')->middleware('auth:api'); // Update
  Route::get('log-activity','API\Log\LogController@index')->middleware('auth:api'); // Log Activity

/// Category \\\
Route::get('category','API\Category\CategoryController@index'); //Index
Route::get('category/{slug}','API\Category\CategoryController@show'); //Show by Slug
Route::post('category','API\Category\CategoryController@store')->middleware('auth:api'); //Store
Route::put('category/{slug}','API\Category\CategoryController@update')->middleware('auth:api'); //Update

/// News \\\
Route::get('news','API\News\NewsController@index'); // Index
Route::post('news','API\News\NewsController@store')->middleware('auth:api'); // Store
Route::put('news/{slug}','API\News\NewsController@update')->middleware('auth:api'); // Update
Route::get('news/{slug}','API\News\NewsController@show'); // Show
Route::get('news-by-name/{name}','API\News\NewsController@showByUserId'); // Show by user id


