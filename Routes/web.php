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

Route::get('core', 'CoreController@index');

Route::group(['middleware' => 'core.auth'], function() {
	Route::get('/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});

Route::group(['prefix' => 'control', 'middleware' => 'core.menu'], function() {

    Route::get('dashboard', 'DashboardController@index');

    Route::group(['namespace' => 'Auth'], function() {
	    Route::group(['prefix' => 'auth'], function() {
			Route::get('/', 'LoginController@showLoginForm')->name('login');
			Route::post('/', 'LoginController@login')->name('login');
			Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
			Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
			Route::post('password/reset', 'ResetPasswordController@reset');
			Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
			Route::get('logout', 'LoginController@logout');
	    });
    });
    
	Route::group(['middleware' => 'core.auth'], function() {

        /*=============================================
        =            Setting CMS            =
        =============================================*/
        
		    Route::get('setting', 'SettingController@create')->middleware('can:super-access')->name('setting');
		    Route::put('setting', 'SettingController@store')->middleware('can:super-access')->name('setting');
        
        /*=====  End of Setting CMS  ======*/


        /*==================================
        =            Module CMS            =
        ==================================*/
        
        Route::group(['prefix' => 'module'], function() {
            Route::get('master', 'ModuleController@index')->middleware('can:super-access')->name('module');
            Route::get('form', 'ModuleController@create')->middleware('can:super-access')->name('module');
            Route::post('form', 'ModuleController@store')->middleware('can:super-access')->name('module');
            Route::put('form', 'ModuleController@store')->middleware('can:super-access')->name('module');
            Route::delete('form', 'ModuleController@destroy')->middleware('can:super-access')->name('module');
        });
        
        /*=====  End of Module CMS  ======*/
        
	});
});
