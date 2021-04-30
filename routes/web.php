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
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth']  , function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['as' => 'users::', 'prefix' => 'users'], function(){
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('/create', 'UsersController@create')->name('create');
        Route::post('/store', 'UsersController@store')->name('store');
        Route::get('/edit/{id}','UsersController@edit')->name('edit');
        Route::put('/update/{id}', 'UsersController@update')->name('update');
        Route::delete('/destroy/{id}','UsersController@delete')->name('delete');
    });

});



