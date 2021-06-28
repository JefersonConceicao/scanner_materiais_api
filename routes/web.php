<?php
Route::get('/permissoes/methodNotAllowed', 'PermissoesController@renderNotAllowed')->name('methodNotAllowed');
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/renderConfirmMail', 'UsersController@renderRequestMailConfirm')->name('requestConfirmMail');
Route::post('/requestConfirmMail', 'UsersController@requestMailConfirm')->name('confirMail');
Route::get('/confirmMail/{token}', 'UsersController@confirmMail')->name('confirmMail');

Route::get('/signup', 'UsersController@renderSignUp')->name('renderSignUp');
Route::post('/saveSignUp', 'UsersController@signUP')->name('signUp');

Route::get('/password/reset', function(){
    return view('vendor.adminlte.passwords.email'); 
});

Route::group(['prefix' => 'users'], function(){
    Route::post('/recoveryPass', 'UsersController@recoveryPassword')->name('recoveryPassword');
    Route::get('/recoveryNewPass/{token}', 'UsersController@renderNewPass')->name('renderNewPass');
});

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
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
