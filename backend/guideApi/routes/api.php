<?php

use Illuminate\Http\Request;

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

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::resource('locals', 'LocalController');

Route::resource('cities', 'CityController');
Route::resource('categories', 'CategorieController');
Route::resource('subCategories', 'SubCategorieController');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

