<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/setores', 'Api\SetoresController@index')->name('setores.index');

Route::get('/listMateriais', 'Api\MateriaisController@list')->name('materiais.list');
Route::post('/scanner', 'Api\MateriaisController@scanner')->name('materiais.scanner');