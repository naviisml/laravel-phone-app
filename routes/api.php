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

// Authentication Routes...
Route::get('/me', 'Auth\UserController@get');

Route::post('/logout', 'Auth\LoginController@logout');

// Guest Routes...
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

// Parser Routes...
Route::get('/parser/logs', 'ParserController@logs')->name('parser.logs');
Route::post('/parser/text', 'ParserController@text')->name('parser.text');
Route::post('/parser/number', 'ParserController@number')->name('parser.number');

// Log Routes...
Route::get('/logs/{type?}', 'LogController@list')->name('logs');
Route::get('/log/{id}', 'LogController@get');
Route::delete('/log/{id}/delete', 'LogController@delete');
