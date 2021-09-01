<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* apis logeo y contrasena - sin proteccion */
Route::post('register', 'userController@register');
Route::post('login', 'userController@authenticate');
Route::put('user/change/no/password/{id}', 'userController@change_password2');
Route::post('user/validate/', 'userController@getByEmailDocument');

Route::group(['middleware' => ['jwt.verify']], function() {
    /*RUTAS PROTEGIDAS CON JWT*/

    /* usuario */
        Route::post('user/update/{id}', 'userController@update');
        Route::put('user/change/password/{id}', 'userController@change_password');

    /* notificaciones */
        Route::get('notificaciones/listar/', 'notificacionesController@list');
        Route::get('notificaciones/user/{id}', 'notificacionesController@getById');

    /* sliders */
        Route::get('sliders/listar/', 'slidersController@list');
        Route::get('sliders/listar/movil', 'slidersController@listMovil');
        Route::get('sliders/listar/web', 'slidersController@listWeb');

    /* filtros */
        /* categorias */
            Route::get('categoria/list/', 'categoriasController@list');
            Route::post('categoria/crear/', 'categoriasController@create');
            Route::delete('categoria/delete/{id}', 'categoriasController@delete');
            Route::get('categoria/id/{id}', 'categoriasController@getById');

        /* filtro_artista */
            Route::get('filtro_artista/listar/', 'filtro_artistaController@list');
            Route::post('filtro_artista/crear/', 'filtro_artistaController@create');
            Route::delete('filtro_artista/borrar/{id}', 'filtro_artistaController@delete');
            Route::get('filtro_artista/id/{id}', 'filtro_artistaController@getById');

        /* filtro_genero */
            Route::get('filtro_genero/listar/', 'filtro_generoController@list');
            Route::post('filtro_genero/crear/', 'filtro_generoController@create');
            Route::delete('filtro_genero/borrar/{id}', 'filtro_generoController@delete');
            Route::get('filtro_genero/id/{id}', 'filtro_generoController@getById');

        /* filtro_instrumento */
            Route::get('filtro_instrumento/listar/', 'filtro_instrumentoController@list');
            Route::post('filtro_instrumento/crear/', 'filtro_instrumentoController@create');
            Route::delete('filtro_instrumento/borrar/{id}', 'filtro_instrumentoController@delete');
            Route::get('filtro_instrumento/id/{id}', 'filtro_instrumentoController@getById');

        
        /* filtro_tipo */
            Route::get('filtro_tipo/listar/', 'filtro_tipoController@list');
            Route::post('filtro_tipo/crear/', 'filtro_tipoController@create');
            Route::delete('filtro_tipo/borrar/{id}', 'filtro_tipoController@delete');
            Route::get('filtro_tipo/id/{id}', 'filtro_tipoController@getById');

        /* filtro_tipo_video */
            Route::get('tipo_video/listar/', 'tipo_videoController@list');
            Route::post('tipo_video/crear/', 'tipo_videoController@create');
            Route::delete('tipo_video/borrar/{id}', 'tipo_videoController@delete');

    /* comentarios */
        Route::get('comentarios/listar/', 'comentariosController@list');
        Route::post('comentarios/crear/', 'comentariosController@create');
        Route::get('comentarios/user/{id}', 'comentariosController@getByUser');
        Route::get('comentarios/video/{id}', 'comentariosController@getByVideo');

    /* tipo_videos */
        Route::post('user/update/{id}', 'userController@update');
        Route::post('user/update/{id}', 'userController@update');
        Route::post('user/update/{id}', 'userController@update');

    /* videos */
        Route::post('user/update/{id}', 'userController@update');
        Route::post('user/update/{id}', 'userController@update');
        Route::post('user/update/{id}', 'userController@update');
    
    /* favoritos */
        Route::get('favoritos/listar/', 'favoritosController@list');
        Route::post('favoritos/crear/', 'favoritosController@create');
        Route::put('favoritos/uptade/{id}', 'favoritosController@update');
        Route::get('favoritos/user/{id}', 'favoritosController@getByUser');

    /* dispositivos */
        Route::get('dispositivos/listar/', 'dispositivosController@list');
        Route::post('dispositivos/crear/', 'dispositivosController@create');
        Route::get('dispositivos/user/{id}', 'dispositivosController@getByIdUser');
        Route::post('dispositivos/enviar/', 'dispositivosController@enviar');
});
