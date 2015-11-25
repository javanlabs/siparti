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

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::post('/image/upload', 'ImageController@upload');

Route::controller('components', 'ComponentController');

Route::get('program-kerja/arsip', ['as' => 'proker.arsip', 'uses' => 'ProgramKerjaController@arsip']);
Route::get('program-kerja/berjalan', ['as' => 'proker.berjalan', 'uses' => 'ProgramKerjaController@berjalan']);
Route::resource('proker', 'ProgramKerjaController');

Route::resource('proker-usulan', 'ProgramKerjaUsulanController');

Route::resource('uji-publik', 'UjiPublikController');

Route::controller('site', 'SiteController');

Route::group(['namespace' => 'My', 'prefix' => 'my', 'middleware' => 'auth'], function(){

    Route::get('/', function(){
        return redirect('my/profile');
    });
    Route::get('usulan', 'ProgramKerjaUsulanController@index');
    Route::get('profile', 'ProfileController@edit');
    Route::put('profile', 'ProfileController@update');
    Route::get('email', 'EmailController@edit');
    Route::put('email', 'EmailController@update');
    Route::get('password', 'PasswordController@edit');
    Route::put('password', 'PasswordController@update');

    Route::get('email/activation/{token}', 'EmailController@activate');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::get('/', function(){
        return view('admin.index');
    });

    Route::resource('settings', 'SettingController', ['only' => ['index', 'store']]);
    Route::resource('roles', 'RoleController');
    Route::resource('auditTrail', 'AuditTrailController');
    Route::resource('programKerja', 'ProgramKerjaController');
    Route::resource('programKerjaUsulan', 'ProgramKerjaUsulanController');
    Route::resource('satuanKerja', 'SatuanKerjaController');
    Route::resource('ujiPublik', 'UjiPublikController');
    Route::resource('comments', 'CommentsController');
    Route::resource('logs', 'LogController');

    Route::post('programKerjaUsulan/deletemultiple',
      [
        'uses' => 'ProgramKerjaUsulanController@deleteMultiple',
        'as' => 'admin.programKerjaUsulan.deleteMultiple'
      ]);

    Route::post('programKerja/deletemultiple',
      [
        'uses' => 'ProgramKerjaController@deleteMultiple',
        'as' => 'admin.programKerja.deleteMultiple'
      ]);

    Route::post('ujiPublik/deletemultiple',
      [
        'uses' => 'UjiPublikController@deleteMultiple',
        'as' => 'admin.ujiPublik.deleteMultiple'
      ]);

    Route::post('comments/deletemultiple',
      [
        'uses' => 'CommentsController@deleteMultiple',
        'as' => 'admin.comments.deleteMultiple'
      ]);
    
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
