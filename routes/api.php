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


Route::group(['middleware' => ['locale']], function () {
Route::get('/news','NewsController@index');
Route::get('/news/{id}','NewsController@item');
Route::get('/interesting','NewsController@interesting');
Route::get('/slides','NewsController@slides');
Route::get('/cats','NewsController@cats');
Route::get('/cats-search','NewsController@catsNews');
Route::get('/world','NewsController@worldMap');
Route::get('/videos','NewsController@newsVideos');
Route::get('/banners','NewsController@banners');
Route::get('/paths','NewsController@paths');
Route::get('/local-map','NewsController@mapLocal');
Route::get('/locations','NewsController@locations');
Route::get('/all-video','NewsController@allVideos');
Route::get('/rossia','NewsController@getRussia');
Route::get('/natural-video','NewsController@allNatureVideos');
Route::get('/locations/{name}','NewsController@getCountrylocations');
Route::get('/search','NewsController@findNews');
Route::get('/sources','NewsController@getSources');
   Route::get('/mail/{name}', 'NewsController@mailSend');
      Route::get('/contact', 'NewsController@contactsGet');
    Route::get('/changelanguage/{lang}', 'NewsController@changeLang');
     Route::post('/register', 'Auth\AuthController@register')->name('register');
Route::post('login', 'Auth\AuthController@login')->name('login');
Route::post('/logout', 'Auth\AuthController@logout');
Route::get('/user', 'Auth\AuthController@user');
});


//Route::middleware('auth:api')->group(function () {

//});

