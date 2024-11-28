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
    return redirect('/admin/dashboard');
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
        Route::get('/', 'App\Http\Controllers\StudentController@index')->name('student.list');
        Route::get('/create', 'App\Http\Controllers\StudentController@create')->name('student.create');
        Route::post('/store', 'App\Http\Controllers\StudentController@store')->name('student.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\StudentController@edit')->name('student.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\StudentController@update')->name('student.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\StudentController@destroy')->name('student.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'App\Http\Controllers\UserController@index')->name('user.list');
        Route::get('/create', 'App\Http\Controllers\UserController@create')->name('user.create');
        Route::post('/store', 'App\Http\Controllers\UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\UserController@update')->name('user.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    });


    Route::group(['prefix' => 'absence'], function () {
        Route::get('/', 'App\Http\Controllers\AbsenceController@index')->name('absence.list');
        Route::get('/create', 'App\Http\Controllers\AbsenceController@create')->name('absence.create');
        Route::post('/store', 'App\Http\Controllers\AbsenceController@store')->name('absence.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\AbsenceController@edit')->name('absence.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\AbsenceController@update')->name('absence.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\AbsenceController@destroy')->name('absence.destroy');
    });

    Route::group(['prefix' => 'qrcode'], function () {
        Route::get('/', 'App\Http\Controllers\QrcodeController@index')->name('qrcode.list');
        Route::get('/create', 'App\Http\Controllers\QrcodeController@create')->name('qrcode.create');
        Route::post('/store', 'App\Http\Controllers\QrcodeController@store')->name('qrcode.store');
        Route::get('/show/{id}', 'App\Http\Controllers\QrcodeController@show')->name('qrcode.show');
        Route::put('/update/{id}', 'App\Http\Controllers\QrcodeController@update')->name('qrcode.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\QrcodeController@destroy')->name('qrcode.destroy');
    });

    Route::group(['prefix' => 'time-table'], function () {
        Route::get('/', 'App\Http\Controllers\TimeTableController@index')->name('time-table.list');
        Route::get('/create', 'App\Http\Controllers\TimeTableController@create')->name('time-table.create');
        Route::post('/store', 'App\Http\Controllers\TimeTableController@store')->name('time-table.store');
        Route::get('/show/{id}', 'App\Http\Controllers\TimeTableController@show')->name('time-table.show');
        Route::put('/update/{id}', 'App\Http\Controllers\TimeTableController@update')->name('time-table.update');
        Route::delete('/destroy/{id}', 'App\Http\Controllers\TimeTableController@destroy')->name('time-table.destroy');
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

Route::get('t', fn () => phpinfo());

use SimpleSoftwareIO\QrCode\Facades\QrCode;
// Route::get('qr-code', function () {
//     // Generate QR Code dalam format PNG
//     $qrCode = QrCode::format('png') // Pastikan format adalah PNG
//                     ->size(200)     // Ukuran QR Code
//                     ->generate('Webappfix.com'); // Data QR Code

//     // Kembalikan QR Code sebagai respons dengan header yang sesuai
//     return response($qrCode)
//             ->header('Content-Type', 'image/png');
// });