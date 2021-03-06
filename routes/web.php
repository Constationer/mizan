<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('client.landing');
});
// Route::get('/jelas', function () {
//     return view('client.naskah');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'Admin','namespace'=>'Admin','middleware'=>['auth','is_admin']], function () {

    Route::group(['prefix' => 'Publish'], function () {
        Route::get('/', 'UserController@index')->name('publish.index');
        Route::post('/store', 'UserController@store')->name('publish.store');
        Route::get('/edit/{id}/edit', 'UserController@edit')->name('publish.edit');
        Route::get('/create', 'UserController@create')->name('publish.create');
        Route::get('/show/{id}', 'UserController@show')->name('publish.show');
        Route::put('/update/{id}', 'UserController@update')->name('publish.update');
        Route::delete('/delete/{id}', 'UserController@destroy')->name('publish.delete');
    });
});

Route::group(['prefix' => 'Admin','namespace'=>'Admin','middleware'=>['auth','is_publish']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/diterima', 'HomeController@terima')->name('home.terima');
    Route::get('/ditolak', 'HomeController@tolak')->name('home.tolak');

    Route::group(['prefix' => 'Category'], function () {
        Route::get('/', 'CategoryController@index')->name('cate.index');
        Route::post('/store', 'CategoryController@store')->name('cate.store');
        Route::get('/edit/{id}/edit', 'CategoryController@edit')->name('cate.edit');
        Route::get('/create', 'CategoryController@create')->name('cate.create');
        Route::get('/show/{id}', 'CategoryController@show')->name('cate.show');
        Route::put('/update/{id}', 'CategoryController@update')->name('cate.update');
        Route::delete('/delete/{id}', 'CategoryController@destroy')->name('cate.delete');
    });
    Route::group(['prefix' => 'Naskah'], function () {
        Route::get('/', 'NaskahController@index')->name('nas.index');
        // Route::post('/store', 'NaskahController@store')->name('nas.store');
        Route::get('/edit/{id}/edit', 'NaskahController@edit')->name('nas.edit');
        // Route::get('/create', 'NaskahController@create')->name('nas.create');
        // Route::get('/show/{id}', 'NaskahController@show')->name('nas.show');
        Route::put('/update/{id}', 'NaskahController@update')->name('nas.update');
        // Route::delete('/delete/{id}', 'NaskahController@destroy')->name('nas.delete');
    });
});

Route::group(['namespace'=>'Client','middleware'=>['auth','is_user']], function () {
    Route::get('/naskah', 'HomeController@index')->name('homes.index');
    Route::get('/naskah-inout', 'HomeController@tambahNaskah')->name('homes.tambah');
    Route::get('/naskah-cate', 'HomeController@category')->name('homes.cate');
    Route::post('/naskah-store', 'HomeController@store')->name('homes.store');
});
