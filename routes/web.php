<?php

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

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', 'AuthController@loginForm')->name('login');
Route::post('login', 'AuthController@login')->name('sign_in');
Route::get('logout', 'AuthController@logout');

Route::group(['middleware' => 'auth.custom'], function (){
    Route::get('/lang/{locale}', 'LanguageController@switchLang');
    Route::get('/', 'MovieController@index');
    Route::get('/load-more', 'MovieController@loadMore');
    Route::get('/movie/{id}', 'MovieController@detail');

    Route::get('/favorites', 'MovieController@favList');
    Route::post('/favorites', 'MovieController@favAdd');
    Route::delete('/favorites/{id}', 'MovieController@favDelete');
});
