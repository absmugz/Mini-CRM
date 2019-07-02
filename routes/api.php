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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/users','UserController@index');
    Route::get('users/{user}','UserController@show');
    Route::patch('users/{user}','UserController@update');
    Route::resource('/companies', 'CompanyController')->except(['index','show']);
});

*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('/companies/create', 'CompanyController@store');
Route::get('/companies/edit/{company}', 'CompanyController@edit');
Route::post('/companies/update/{company}', 'CompanyController@update');
Route::post('/companies/delete/{company}', 'CompanyController@destroy');
Route::get('/companies', 'CompanyController@index');
Route::post('/upload-file', 'CompanyController@uploadFile');
Route::get('/companies/{company}', 'CompanyController@show');
Route::get('/users', 'UserController@index');
Route::post('/users/create', 'UserController@store');
Route::post('/users/delete/{user}', 'UserController@destroy');
Route::get('/users/edit/{user}', 'UserController@edit');
Route::post('/users/update/{user}', 'UserController@update');




