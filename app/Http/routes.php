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

Route::get('/', function(){
    return view('home.index');
});

Route::controller('components', 'ComponentController');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);
});
