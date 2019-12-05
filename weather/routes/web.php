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

Route::get('/', function (){
return view('welcome');
});


Route::group(['prefix' => 'feedback', 'as' => 'feedback.'], function () {
    Route::get('/create',
        function () {
            return view('feedback.create');
        }
    )->name('create');

    Route::get('/show',
        [
            'uses'=>'FeedbackController@show',
            'as'=>'show'
        ]
    )->middleware('auth');

});







Route::post('/feedback/create',
    [
        'uses'=>'FeedbackController@create',
        'as'=>'feedback.create'
    ]);


Auth::routes();

Route::get('/weather',
    [
        'uses'=>'ParseController@index',
        'as'=>'weather.index'
    ]
)->middleware('auth');

