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

Route::get('cloud/assets/{path?}', 'FileManagerController@getStorageURL')->where('path', '.*');

/*Route::group(['prefix' => 'control', 'middleware' => 'core.auth'], function() {
	Route::get('/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});*/

Route::group(['prefix' => 'control'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::group(['prefix' => 'auth'], function() {
            Route::get('/', 'LoginController@showLoginForm')->name('login');
            Route::post('/', 'LoginController@login')->name('login');
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('password/reset', 'ResetPasswordController@reset');
            Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::get('logout', 'LoginController@logout')->name('logout');
        });
    });
    
});

Route::group(['prefix' => 'control', 'middleware' => 'core.menu'], function() {

    Route::group(['middleware' => 'core.auth'], function() {

        Route::get('spa/{any}', 'DashboardController@spa')
            ->where('any', '^((?!auth).)*$');

        Route::post('menu', 'MenuController@getMenu');

        Route::get('dashboard', 'DashboardController@index');
        
        /*=============================================
        =            Setting CMS            =
        =============================================*/
        
		    Route::post('setting/data', 'SettingController@data')->middleware('can:menu-core')->name('cms.setting.config');
		    Route::get('setting', 'SettingController@create')->middleware('can:menu-core')->name('cms.setting.create');
		    Route::put('setting', 'SettingController@store')->middleware('can:menu-core')->name('cms.setting.store');
        
        /*=====  End of Setting CMS  ======*/


        /*==================================
        =            Module CMS            =
        ==================================*/
        
        Route::group(['prefix' => 'module'], function() {
            Route::get('master', 'ModuleController@index')->middleware('can:super-access')->name('cms.module.master');
            Route::get('form', 'ModuleController@create')->middleware('can:super-access')->name('cms.module.create');
            Route::post('form', 'ModuleController@store')->middleware('can:super-access')->name('cms.module.store');
            Route::put('form', 'ModuleController@store')->middleware('can:super-access')->name('cms.module.store');
            Route::delete('form', 'ModuleController@destroy')->middleware('can:super-access')->name('cms.module.delete');

            Route::post('data', 'ModuleController@data')->middleware('can:super-access');
            Route::post('show', 'ModuleController@show')->middleware('can:super-access');
        });
        
        /*=====  End of Module CMS  ======*/

        /*===========================================
        =            Laravel Filemanager            =
        ===========================================*/
        
            Route::get('/laravel-filemanager', 'FileManagerController@index')->middleware('can:menu-filemanager-core')->name('cms.filemanager.master');
        
        /*=====  End of Laravel Filemanager  ======*/
        
        
	});
});
