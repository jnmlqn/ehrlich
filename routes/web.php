<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        if (auth()->check()) {
            return redirect('home');
        }

            return view('login');
    }
)->name('login');

Route::get('auth/github', 'App\Http\Controllers\AuthController@gitRedirect');
Route::get('auth/github/callback', 'App\Http\Controllers\AuthController@gitLoginCallback');

Route::group(
    [
        'middleware' => 'auth'
    ],
    function ($router) {
        Route::get('auth/github/logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('home', 'App\Http\Controllers\AppController@index');
        Route::get('weather', 'App\Http\Controllers\AppController@weather');
    }
);
