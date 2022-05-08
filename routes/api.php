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

Route::get('/parse/text/{input}', 'PhoneController@text')->name('parser.text');
Route::get('/parse/number/{input}', 'PhoneController@number')->name('parser.number');
Route::post('/logout', 'Auth\LoginController@logout');

// Guest Routes...
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
