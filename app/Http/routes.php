<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', 'VideosController@index');
    Route::get('/description/{id}', ['uses' => 'VideosController@ver', 'as' => 'videos.ver']);

Route::group(['middleware' => 'web'], function () {
   
    Route::auth();
    Route::post('/like/{user}/{video}', ['uses' => 'VideosController@like', 'as' => 'videos.like']);
    Route::post('/unlike/{user}/{video}', ['uses' => 'VideosController@unlike', 'as' => 'videos.unlike']);
    Route::resource('videos', 'VideosController');
});


