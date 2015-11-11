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

Route::get('program-kerja/arsip', 'ProgramKerjaController@arsip');
Route::get('program-kerja/berjalan', 'ProgramKerjaController@berjalan');
Route::get('program-kerja/usulan', 'ProgramKerjaController@usulan');
Route::resource('proker', 'ProgramKerjaController');

Route::controller('site', 'SiteController');

Route::group(['namespace' => 'My', 'prefix' => 'my', 'middleware' => 'auth'], function(){
    Route::get('profile', 'ProfileController@edit');
    Route::put('profile', 'ProfileController@update');
    Route::get('email', 'EmailController@edit');
    Route::put('email', 'EmailController@update');
    Route::get('password', 'PasswordController@edit');
    Route::put('password', 'PasswordController@update');

    Route::get('email/activation/{token}', 'EmailController@activate');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);
    Route::resource('roles', 'RoleController');
    Route::resource('auditTrail', 'AuditTrailController');

    Route::group(['namespace' => 'User'], function(){
        Route::resource('users', 'UserController');
        Route::resource('profile', 'ProfileController');

        Route::resource('password', 'PasswordController');
        Route::post('password/{id}/reset', ['uses' => 'PasswordController@reset', 'as' => 'admin.password.reset']);
        Route::post('password/{id}/generate', ['uses' => 'PasswordController@generate', 'as' => 'admin.password.generate']);

        Route::resource('account', 'AccountController');
        Route::resource('role', 'RoleController', ['only' => ['edit', 'update']]);
    });
});
