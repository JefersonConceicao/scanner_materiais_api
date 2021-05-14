<?php
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/permissoes/methodNotAllowed', 'PermissoesController@renderNotAllowed')->name('methodNotAllowed');

Auth::routes();
Route::group(['middleware' => ['auth', 'verifyPermission']] , function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['as' => 'users::', 'prefix' => 'users'], function(){
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('/create', 'UsersController@create')->name('create');
        Route::post('/store', 'UsersController@store')->name('store');
        Route::get('/edit/{id}','UsersController@edit')->name('edit');
        Route::put('/update/{id}', 'UsersController@update')->name('update');
        Route::delete('/destroy/{id}','UsersController@destroy')->name('delete');
        Route::get('/view/{id}', 'UsersController@show')->name('view');
        Route::get('/perfil', 'UsersController@profile')->name('profile');
        Route::put('/changePassword', 'UsersController@changePassword')->name('changePassword');
        Route::post('/uploadPhotoProfile', 'UsersController@uploadPhotoProfile')->name('uploadPhotoProfile');
        Route::delete('/deleteAll', 'UsersController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'permissoes::', 'prefix' => 'permissoes'], function(){
        Route::get('/', 'PermissoesController@index')->name('index');
        Route::get('/create', 'PermissoesController@create')->name('create');
        Route::get('/renderViewSessionRevalid', 'PermissoesController@renderViewSessionRevalid')->name('revalidSession');
        Route::post('/reloadSession', 'PermissoesController@reloadSession')->name('reloadSession');
    });

    Route::group(['as' => 'modulos::', 'prefix' => 'modulos'], function(){
        Route::get('/', 'ModulosController@index')->name('index');
        Route::get('/create', 'ModulosController@create')->name('create');
        Route::post('/store', 'ModulosController@store')->name('store');
        Route::get('/edit/{id}', 'ModulosController@edit')->name('edit');
        Route::put('/update/{id}', 'ModulosController@update')->name('update');
        Route::delete('/delete/{id}', 'ModulosController@destroy')->name('delete');
    });

    Route::group(['as' => 'funcionalidades::', 'prefix' => 'funcionalidades'], function(){
        Route::get('/', 'FuncionalidadesController@index')->name('index');
        Route::get('/create', 'FuncionalidadesController@create')->name('create');
        Route::post('/store', 'FuncionalidadesController@store')->name('store');
        Route::get('/edit/{id}', 'FuncionalidadesController@edit')->name('edit');
        Route::put('/update/{id}', 'FuncionalidadesController@update')->name('update');
        Route::delete('/delete/{id}', 'FuncionalidadesController@delete')->name('delete');
    });

    Route::group(['as' => 'roles::', 'prefix' => 'roles'], function(){
        Route::get('/', 'RolesController@index')->name('index');
        Route::get('/create', 'RolesController@create')->name('create');
        Route::post('/store', 'RolesController@store')->name('store');
        Route::get('/edit/{id}', 'RolesController@edit')->name('edit');
        Route::put('/update/{id}', 'RolesController@update')->name('update');
        Route::delete('/delete/{id}', 'RolesController@delete')->name('delete');
    });

    Route::group(['as' => 'uf::', 'prefix' => 'uf'], function(){
        Route::get('/', 'UFController@index')->name('index');
        Route::get('/create', 'UFController@create')->name('create');
        Route::post('/store', 'UFController@store')->name('store');
        Route::get('/edit/{id}', 'UFController@edit')->name('edit');
        Route::put('/update/{id}', 'UFController@update')->name('update');
        Route::delete('/delete/{id}', 'UFController@delete')->name('delete');
    });

    Route::group(['as' => 'territoriosTuristicos::', 'prefix' => 'territoriosTuristicos'], function(){
        Route::get('/', 'TerritoriosTuristicosController@index')->name('index');
        Route::get('/create', 'TerritoriosTuristicosController@create')->name('create');
        Route::post('/store', 'TerritoriosTuristicosController@store')->name('store');
        Route::get('/edit/{id}', 'TerritoriosTuristicosController@edit')->name('edit');
        Route::put('/update/{id}', 'TerritoriosTuristicosController@update')->name('update');
        Route::delete('/delete/{id}', 'TerritoriosTuristicosController@delete')->name('delete');
    });

    Route::group(['as' => 'zonasTuristicas::', 'prefix' => 'zonasTuristicas'], function(){
        Route::get('/', 'ZonasTuristicasController@index')->name('index');
        Route::get('/create', 'ZonasTuristicasController@create')->name('create');
        Route::post('/store', 'ZonasTuristicasController@store')->name('store');
        Route::get('/edit/{id}', 'ZonasTuristicasController@edit')->name('edit');
        Route::put('/update/{id}', 'ZonasTuristicasController@update')->name('update');
        Route::delete('/delete/{id}', 'ZonasTuristicasController@delete')->name('delete');
    });

    Route::group(['as' => 'paises::', 'prefix' => 'paises'], function(){
        Route::get('/', 'PaisesController@index')->name('index');
        Route::get('/create', 'PaisesController@create')->name('create');
        Route::post('/store', 'PaisesController@store')->name('store');
        Route::get('/edit/{id}', 'PaisesController@edit')->name('edit');
        Route::put('/update/{id}', 'PaisesController@update')->name('update');
        Route::delete('/delete/{id}', 'PaisesController@delete')->name('delete');
    });

    Route::group(['as' => 'tiposEventosFestas::', 'prefix' => 'tiposEventosFestas'], function(){
        Route::get('/', 'TiposEventosFestasController@index')->name('index');
        Route::get('/create', 'TiposEventosFestasController@create')->name('create');
        Route::post('/store', 'TiposEventosFestasController@store')->name('store');
        Route::get('/edit/{id}', 'TiposEventosFestasController@edit')->name('edit');
        Route::put('/update/{id}', 'TiposEventosFestasController@update')->name('update');
        Route::delete('/delete/{id}', 'TiposEventosFestasController@delete')->name('delete');
    });

    Route::group(['as' => 'tiposInfraestruturas::', 'prefix' => 'tiposInfraestruturas'], function(){
        Route::get('/', 'TiposInfraestruturasController@index')->name('index');
        Route::get('/create', 'TiposInfraestruturasController@create')->name('create');
        Route::post('/store', 'TiposInfraestruturasController@store')->name('store');
        Route::get('/edit/{id}', 'TiposInfraestruturasController@edit')->name('edit');
        Route::put('/update/{id}', 'TiposInfraestruturasController@update')->name('update');
        Route::delete('/delete/{id}', 'TiposInfraestruturasController@delete')->name('delete');
        Route::delete('/deleteAll', 'TiposInfraestruturasController@deleteAll')->name('deleteAll');
    });
});



