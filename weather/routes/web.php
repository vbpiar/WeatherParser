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

Route::get('/',[
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::group(['prefix' => 'feedback', 'as' => 'feedback.'], function () {

    Route::get('/create',
        ['uses'=>'FeedbackController@create',
            'as'=>'create'
        ]);

    Route::get('/show',
        [
            'uses'=>'FeedbackController@show',
            'as'=>'show'
        ]
    )->middleware('auth');

    Route::post('/store',
        [
            'uses'=>'FeedbackController@store',
            'as'=>'store'
        ]);
});

Auth::routes();

Route::get('/weather',
    [
        'uses'=>'WeatherController@index',
        'as'=>'weather.index'
    ]
)->middleware('auth');

