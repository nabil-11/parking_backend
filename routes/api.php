<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['module' => 'User',  'namespace' => '\App\Http\Controllers\User'], function() {
    Route::post('/user/register', 'UserController@handleUserRegister')->name('handleUserRegister');
    Route::post('/user/login', 'UserController@handleUserLogin')->name('handleUserLogin');
    Route::get('/user/logout', 'UserController@handleLogout')->name('handleLogout');

});

Route::group(['module' => 'User',  'namespace' => '\App\Http\Controllers'], function() {
    Route::post('/parking', 'responsableController@handleResponsableAddParking')->name('addParking')->middleware('auth:sanctum');
    Route::get('/parking', 'responsableController@showResponsableParking')->name('showResponsableParking')->middleware('auth:sanctum');


    Route::get('/type_abonnement', 'responsableController@showTypeAbonnement')->name('showTypeAbonnement');

});
