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

Route::get('/parser/logs', 'PhoneController@logs')->name('parser.logs');
Route::post('/parser/text', 'PhoneController@text')->name('parser.text');
Route::post('/parser/number', 'PhoneController@number')->name('parser.number');

// Authentication Routes...
Route::get('/me', 'Auth\UserController@get');

Route::post('/logout', 'Auth\LoginController@logout');

// Guest Routes...
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
