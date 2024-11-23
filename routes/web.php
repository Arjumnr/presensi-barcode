<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

//auth
Route::get('/auth/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@authenticate')->name('login.post');

Route::get('/auth/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/auth/register', 'App\Http\Controllers\AuthController@registPost')->name('register.post');

Route::get('/auth/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');


// middleware
Route::group(['prefix' => 'admin',  'namespace' => 'App\Http\Controllers',  'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    

    Route::group(['prefix' => 'student'], function () {
        Route::get('/', 'App\Http\Controllers\AuthController@index')->name('student.index');
        Route::get('/data', 'App\Http\Controllers\AuthController@data')->name('student.data');
        Route::get('/create', 'App\Http\Controllers\AuthController@create')->name('student.create');
        Route::post('/store', 'App\Http\Controllers\AuthController@store')->name('student.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\AuthController@edit')->name('student.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\AuthController@update')->name('student.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\AuthController@destroy')->name('student.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'App\Http\Controllers\UserController@index')->name('user.list');
        Route::get('/data', 'App\Http\Controllers\UserController@data')->name('user.data');
        Route::get('/create', 'App\Http\Controllers\UserController@create')->name('user.create');
        Route::post('/store', 'App\Http\Controllers\UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\UserController@update')->name('user.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    });

    // setting
    // Route::group(['prefix' => 'setting'], function () {
    //     Route::get('/', 'App\Http\Controllers\Admin\AdminSettingController@index')->name('setting.index');
    //     Route::post('/store', 'App\Http\Controllers\Admin\AdminSettingController@store')->name('setting.store');
    // });
});


//clear cache 
Route::get('/cc', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'Cache is cleared';
});