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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Role
Route::get('role/show','RoleController@show');
Route::get('role/{id}','RoleController@showById');
Route::post('role','RoleController@create');
Route::put('role/{id}','RoleController@update');
Route::delete('role/{id}','RoleController@delete');

//shift
Route::get('shift/show','ShiftController@show');
Route::get('shift/{id}','ShiftController@showById');
Route::post('shift','ShiftController@create');
Route::put('shift/{id}','ShiftController@update');
Route::delete('shift/{id}','ShiftController@delete');

//kendaraan
Route::get('kendaraan/show','KendaraanController@show');
Route::get('kendaraan/{id}','KendaraanController@showById');
Route::post('kendaraan','KendaraanController@create');
Route::put('kendaraan/{id}','KendaraanController@update');
Route::delete('kendaraan/{id}','KendaraanController@delete');

//pegawai
Route::get('pegawai/show','PegawaiController@show');
Route::get('pegawai/{id}','PegawaiController@showById');
Route::post('pegawai','PegawaiController@create');
Route::put('pegawai/{id}','PegawaiController@update');
Route::delete('pegawai/{id}','PegawaiController@delete');
Route::POST('/pegawai/mobileauthenticate','PegawaiController@mobileauthenticate');