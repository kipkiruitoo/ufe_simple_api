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


Route::post('/user/register', 'UserController@register');


Route::post('/user/login', 'UserController@login');


Route::post('/user/validate', 'UserController@validate')


Route::get('/search/nrb', 'ApiController@nrbsearch');
Route::get('/search/ntsa', 'ApiController@ntsasearch');
Route::get('/search/civil', 'ApiController@civilsearch');


// center routes
Route::get('/centres', 'ApiController@getCenters');
Route::get('/centres/{center}/services', 'ApiController@getCenterServices');
Route::get('/search/centres', 'ApiController@searchCentre');

// county routes
Route::get('/counties', 'ApiController@getCounties');

// mda routes
Route::get('/mdas', 'ApiController@getMdas');
Route::get('/mdas/{mda}/services', 'ApiController@getMdaService');
Route::get('search/mda', 'ApiController@searchMda');

// trending services
Route::get('/services/trending', 'ApiController@getTrendingServices');


Route::get('/search/services', 'ApiController@searchService');
