<?php
//SETORES
Route::get('/setores', 'Api\SetoresController@index')->name('setores.index');
Route::post('/storeSetor', 'Api\SetoresController@store')->name('setores.store');
Route::delete('/deleteSetor/{id}', 'Api\SetoresController@delete')->name('setores.delete');

//MATERIAIS
Route::get('/listMateriais/{setorId}', 'Api\MateriaisController@list')->name('materiais.list');
Route::post('/saveMateriais', 'Api\MateriaisController@store')->name('materiais.store');
Route::put('/updateMateriais/{id}', 'Api\MateriaisController@update')->name('materiiais.update');
Route::delete('/deleteMateriais/{id}', 'Api\MateriaisController@deleteMaterial')->name('materiais.delete');

//SCANNER
Route::get('/scanner', 'Api\MateriaisController@scanner')->name('materiais.scanner');

