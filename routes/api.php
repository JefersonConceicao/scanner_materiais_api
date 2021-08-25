<?php
Route::get('/setores', 'Api\SetoresController@index')->name('setores.index');
Route::get('/listMateriais/{setorId}', 'Api\MateriaisController@list')->name('materiais.list');
Route::get('/scanner', 'Api\MateriaisController@scanner')->name('materiais.scanner');
Route::post('/saveMateriais', 'Api\MateriaisController@store')->name('materiais.store');