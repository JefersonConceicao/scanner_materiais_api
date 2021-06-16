<?php

Route::get('/', function () {
    return redirect('/login');
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
        Route::delete('/deleteAll', 'UFController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'territoriosTuristicos::', 'prefix' => 'territoriosTuristicos'], function(){
        Route::get('/', 'TerritoriosTuristicosController@index')->name('index');
        Route::get('/create', 'TerritoriosTuristicosController@create')->name('create');
        Route::post('/store', 'TerritoriosTuristicosController@store')->name('store');
        Route::get('/edit/{id}', 'TerritoriosTuristicosController@edit')->name('edit');
        Route::put('/update/{id}', 'TerritoriosTuristicosController@update')->name('update');
        Route::delete('/delete/{id}', 'TerritoriosTuristicosController@delete')->name('delete');
        Route::delete('/deleteAll', 'TerritoriosTuristicosController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'zonasTuristicas::', 'prefix' => 'zonasTuristicas'], function(){
        Route::get('/', 'ZonasTuristicasController@index')->name('index');
        Route::get('/create', 'ZonasTuristicasController@create')->name('create');
        Route::post('/store', 'ZonasTuristicasController@store')->name('store');
        Route::get('/edit/{id}', 'ZonasTuristicasController@edit')->name('edit');
        Route::put('/update/{id}', 'ZonasTuristicasController@update')->name('update');
        Route::delete('/delete/{id}', 'ZonasTuristicasController@delete')->name('delete');
        Route::delete('/deleteAll', 'ZonasTuristicasController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'paises::', 'prefix' => 'paises'], function(){
        Route::get('/', 'PaisesController@index')->name('index');
        Route::get('/create', 'PaisesController@create')->name('create');
        Route::post('/store', 'PaisesController@store')->name('store');
        Route::get('/edit/{id}', 'PaisesController@edit')->name('edit');
        Route::put('/update/{id}', 'PaisesController@update')->name('update');
        Route::delete('/delete/{id}', 'PaisesController@delete')->name('delete');
        Route::delete('/deleteAll', 'PaisesController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'tiposEventosFestas::', 'prefix' => 'tiposEventosFestas'], function(){
        Route::get('/', 'TiposEventosFestasController@index')->name('index');
        Route::get('/create', 'TiposEventosFestasController@create')->name('create');
        Route::post('/store', 'TiposEventosFestasController@store')->name('store');
        Route::get('/edit/{id}', 'TiposEventosFestasController@edit')->name('edit');
        Route::put('/update/{id}', 'TiposEventosFestasController@update')->name('update');
        Route::delete('/delete/{id}', 'TiposEventosFestasController@delete')->name('delete');
        Route::delete('/deleteAll', 'TiposEventosFestasController@deleteAll')->name('deleteAll');
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

    Route::group(['as' => 'localidades::', 'prefix' => 'localidades'], function(){
        Route::get('/', 'LocalidadesController@index')->name('index');
        Route::get('/create', 'LocalidadesController@create')->name('create');
        Route::post('/store', 'LocalidadesController@store')->name('store');
        Route::get('/edit/{id}', 'LocalidadesController@edit')->name('edit');
        Route::put('/update/{id}', 'LocalidadesController@update')->name('update');
        Route::delete('/delete/{id}', 'LocalidadesController@delete')->name('delete');
        Route::get('/details/{id}', 'LocalidadesController@details')->name('details');

        //LOCALIDADES DISTANCIA
        Route::get('/createDistLocalidades/{id}', 'LocalidadesController@createDistanciaLocalidades')->name('createDistLocalidades');
        Route::post('/storeDistLocalidades', 'LocalidadesController@storeDistanciaLocalidades')->name('storeDistLocalidades');
        Route::get('/editDistLocalidades/{id}', 'LocalidadesController@editDistanciaLocalidades')->name('editDistLocalidades');
        Route::put('/updateDistLocalidades/{id}', 'LocalidadesController@updateDistanciaLocalidades')->name('updateDistLocalidades');
        Route::delete('/deleteDistlocalidades/{id}', 'LocalidadesController@deleteDistanciaLocalidades')->name('deleteDistLocalidades');
        
        //LOCALIDADES INFRAESTRUTURA
        Route::get('/createInfraLocalidades/{id}', 'LocalidadesController@createInfraLocalidades')->name('createInfraLocalidades');
        Route::post('/storeInfraLocalidades', 'LocalidadesController@storeInfraLocalidades')->name('storeInfraLocalidades');
        Route::get('/editInfraLocalidades/{id}', 'LocalidadesController@editInfraLocalidades')->name('editInfraLocalidades');
        Route::put('/updateInfraLocalidades/{id}', 'LocalidadesController@updateInfraLocalidades')->name('updateInfraLocalidades');
        Route::delete('/deleteInfraLocalidades/{id}', 'LocalidadesController@deleteInfraLocalidades')->name('deleteInfraLocalidades');
        
        //LOCALIDADES EVENTO/FESTA
        Route::get('/createEFLocalidade', 'LocalidadesController@createEFLocalidades')->name('createEFLocalidades');
        Route::post('/storeEFLocalidade', 'LocalidadesController@storeEFLocalidades')->name('storeEFLocalidades');
        Route::get('/editEFLocalidade/{id}', 'LocalidadesController@editEFLocalidades')->name('editEFLocalidades');
        Route::put('/updateEFLocalidade/{id}', 'LocalidadesController@updateEFLocalidades')->name('updateEFLocalidades');
        Route::delete('/deleteEFLocalidade/{id}', 'LocalidadesController@deleteEFLocalidades')->name('deleteEFLocalidades');
    });

    Route::group(['as' => 'tiposProjetos::', 'prefix' => 'tiposProjetos'], function(){
        Route::get('/', 'TiposProjetosController@index')->name('index');
        Route::get('/create', 'TiposProjetosController@create')->name('create');
        Route::post('/store', 'TiposProjetosController@store')->name('store');
        Route::get('/edit/{id}', 'TiposProjetosController@edit')->name('edit');
        Route::put('/update/{id}', 'TiposProjetosController@update')->name('update');
        Route::delete('/delete/{id}', 'TiposProjetosController@delete')->name('delete');
    });

    Route::group(['as' => 'setores::', 'prefix' => 'setores'], function(){
        Route::get('/', 'SetoresController@index')->name('index');
        Route::get('/create', 'SetoresController@create')->name('create');
        Route::post('/store', 'SetoresController@store')->name('store');
        Route::get('/edit/{id}', 'SetoresController@edit')->name('edit');
        Route::put('/update/{id}', 'SetoresController@update')->name('update');
        Route::delete('/delete/{id}', 'SetoresController@delete')->name('delete');
        Route::delete('/deleteAll', 'SetoresController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'categoriaInstrumentos::', 'prefix' => 'categoriaInstrumentos'], function(){
        Route::get('/', 'CategoriaInstrumentosController@index')->name('index');
        Route::get('/create', 'CategoriaInstrumentosController@create')->name('create');
        Route::post('/store', 'CategoriaInstrumentosController@store')->name('store');
        Route::get('/edit/{id}', 'CategoriaInstrumentosController@edit')->name('edit');
        Route::put('/update/{id}', 'CategoriaInstrumentosController@update')->name('update');
        Route::delete('/delete/{id}', 'CategoriaInstrumentosController@delete')->name('delete');
        Route::delete('/deleteAll', 'CategoriaInstrumentosController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'checkListItens::', 'prefix' => 'checkListItens'], function(){
        Route::get('/', 'CheckListItensController@index')->name('index');
        Route::get('/create', 'CheckListItensController@create')->name('create');
        Route::post('/store', 'CheckListItensController@store')->name('store');
        Route::get('/edit/{id}', 'CheckListItensController@edit')->name('edit');
        Route::put('/update/{id}', 'CheckListItensController@update')->name('update');
        Route::delete('/delete/{id}', 'CheckListItensController@delete')->name('delete');
        Route::delete('/deleteAll', 'CheckListItensController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'checkListEstruturas::', 'prefix' => 'checkListEstruturas'], function(){
        Route::get('/', 'CheckListEstruturasController@index')->name('index');
        Route::get('/create', 'CheckListEstruturasController@create')->name('create');
        Route::post('/store', 'CheckListEstruturasController@store')->name('store');
        Route::get('/edit/{id}', 'CheckListEstruturasController@edit')->name('edit');
        Route::put('/update/{id}', 'CheckListEstruturasController@update')->name('update');
        Route::delete('/delete/{id}', 'CheckListEstruturasController@delete')->name('delete');
        Route::delete('/deleteAll', 'CheckListEstruturasController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'checkListModelos::', 'prefix' => 'checkListModelos'], function(){
        Route::get('/', 'CheckListModelosController@index')->name('index');
        Route::get('/create', 'CheckListModelosController@create')->name('create');
        Route::post('/store', 'CheckListModelosController@store')->name('store');
        Route::get('/edit/{id}', 'CheckListModelosController@edit')->name('edit');
        Route::put('/update/{id}', 'CheckListModelosController@update')->name('update');
        Route::delete('/delete/{id}', 'CheckListModelosController@delete')->name('delete');
        Route::delete('/deleteAll', 'CheckListModelosController@deleteAll')->name('deleteAll');
        Route::get('/getListJSON', 'CheckListModelosController@getListModelosJSON')->name('getListJSON');
    });

    Route::group(['as' => 'elementoDespesas::', 'prefix' => 'elementoDespesas'], function(){
        Route::get('/', 'ElementoDespesasController@index')->name('index');
        Route::get('/create', 'ElementoDespesasController@create')->name('create');
        Route::post('/store', 'ElementoDespesasController@store')->name('store');
        Route::get('/edit/{id}', 'ElementoDespesasController@edit')->name('edit');
        Route::put('/update/{id}', 'ElementoDespesasController@update')->name('update');
        Route::delete('/delete/{id}', 'ElementoDespesasController@delete')->name('delete');
        Route::delete('/deleteAll', 'ElementoDespesasController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'fonteRecursos::', 'prefix' => 'fonteRecursos'], function(){
        Route::get('/', 'FonteRecursosController@index')->name('index');
        Route::get('/create', 'FonteRecursosController@create')->name('create');
        Route::post('/store', 'FonteRecursosController@store')->name('store');
        Route::get('/edit/{id}', 'FonteRecursosController@edit')->name('edit');
        Route::put('/update/{id}', 'FonteRecursosController@update')->name('update');
        Route::delete('/delete/{id}', 'FonteRecursosController@delete')->name('delete');
        Route::delete('/deleteAll', 'FonteRecursosController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'modalidadesApoio::', 'prefix' => 'modalidadesApoio'], function(){
        Route::get('/', 'ModalidadesApoioController@index')->name('index');
        Route::get('/create', 'ModalidadesApoioController@create')->name('create');
        Route::post('/store', 'ModalidadesApoioController@store')->name('store');
        Route::get('/edit/{id}', 'ModalidadesApoioController@edit')->name('edit');
        Route::put('/update/{id}', 'ModalidadesApoioController@update')->name('update');
        Route::delete('/delete/{id}', 'ModalidadesApoioController@delete')->name('delete');
        Route::delete('/deleteAll', 'ModalidadesApoioController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'modalidadesLicitacao::', 'prefix' => 'modalidadesLicitacao'], function(){
        Route::get('/', 'ModalidadesLicitacaoController@index')->name('index');
        Route::get('/create', 'ModalidadesLicitacaoController@create')->name('create');
        Route::post('/store', 'ModalidadesLicitacaoController@store')->name('store');
        Route::get('/edit/{id}', 'ModalidadesLicitacaoController@edit')->name('edit');
        Route::put('/update/{id}', 'ModalidadesLicitacaoController@update')->name('update');
        Route::delete('/delete/{id}', 'ModalidadesLicitacaoController@delete')->name('delete');
        Route::delete('/deleteAll', 'ModalidadesLicitacaoController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'projetoAtividades::', 'prefix' => 'projetoAtividades'], function(){
        Route::get('/', 'ProjetoAtividadesController@index')->name('index');
        Route::get('/create', 'ProjetoAtividadesController@create')->name('create');
        Route::post('/store', 'ProjetoAtividadesController@store')->name('store');
        Route::get('/edit/{id}', 'ProjetoAtividadesController@edit')->name('edit');
        Route::put('/update/{id}', 'ProjetoAtividadesController@update')->name('update');
        Route::delete('/delete/{id}', 'ProjetoAtividadesController@delete')->name('delete');
        Route::delete('/deleteAll', 'ProjetoAtividadesController@deleteAll')->name('deleteAll');
    });

    Route::group(['as' => 'proponentes::', 'prefix' => 'proponentes'], function(){
        Route::get('/', 'ProponentesController@index')->name('index');
        Route::get('/create', 'ProponentesController@create')->name('create');
        Route::get('/getCNPJWSReceita/{cnpj}', 'ProponentesController@getCNPJProponenteReceita')->name('getCNPJReceita');
        Route::post('/store', 'ProponentesController@store')->name('store');
        Route::get('/edit/{id}', 'ProponentesController@edit')->name('edit');
        Route::put('/update/{id}', 'ProponentesController@update')->name('update');
        Route::delete('/delete/{id}', 'ProponentesController@delete')->name('delete');
    });

    Route::group(['as' => 'projetos::', 'prefix' => 'projetos'], function(){
        Route::get('/', 'ProjetosController@index')->name('index');
        Route::get('/create', 'ProjetosController@create')->name('create');
        Route::post('/store', 'ProjetosController@store')->name('store');
        Route::get('/edit/{id}', 'ProjetosController@edit')->name('edit');
        Route::put('/update/{id}', 'ProjetosController@update')->name('update');
        Route::delete('/delete/{id}', 'ProjetosController@delete')->name('delete');
        Route::get('/view/{id}', 'ProjetosController@show')->name('view');
    });
});