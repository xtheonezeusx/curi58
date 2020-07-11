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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth',
], function() {
    // dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // actualizar perfil
    Route::get('update-profile', 'DashboardController@perfil')->name('update.profile');
    Route::put('update-profile', 'DashboardController@profile')->name('profile');
    // actualizar contraseña
    Route::get('update-password', 'DashboardController@perfil2')->name('update.password');
    Route::put('update-password', 'DashboardController@password')->name('password');

    // resource grupos
    Route::resource('grupos', 'GrupoController');

    // clientes
    Route::get('clientes', 'ClienteController@index')->name('clientes.index');
    Route::get('clientes/getClientes', 'ClienteController@getClientes')->name('clientes.getClientes');
    Route::get('clientes/instituciones/{id}', 'ClienteController@getFacultades')->name('clientes.getFacultades');
    Route::post('clientes', 'ClienteController@store')->name('clientes.store');
    Route::get('clientes/{id}', 'ClienteController@edit')->name('clientes.edit');
    Route::put('clientes/{id}', 'ClienteController@update')->name('clientes.update');
    Route::delete('clientes/{id}', 'ClienteController@destroy')->name('clientes.destroy');

    // usuarios
    Route::get('usuarios', 'UserController@index')->name('usuarios.index');
    Route::post('usuarios', 'UserController@store')->name('usuarios.store');
    Route::get('usuarios/{id}/edit', 'UserController@edit')->name('usuarios.edit');
    Route::delete('usuarios/{id}', 'UserController@destroy')->name('usuarios.destroy');
    Route::get('usuarios/create', 'UserController@create')->name('usuarios.create');
    Route::put('usuarios/{id}', 'UserController@update')->name('usuarios.update');

    // instituciones
    Route::resource('instituciones', 'InstitucionController');
    
    // facultades
    Route::get('instituciones/{institucion}/getFacultades', 'FacultadController@getFacultades')->name('facultades.getFacultades');
    Route::post('instituciones/{institucion}', 'FacultadController@store')->name('facultades.store');
    Route::get('instituciones/{institucion}/{facultad}/getFacultad', 'FacultadController@getFacultad')->name('facultades.getFacultad');
    Route::put('instituciones/{institucion}/{facultad}', 'FacultadController@update')->name('facultades.update');
    Route::get('instituciones/{institucion}/{facultad}', 'FacultadController@show')->name('facultades.show');
    Route::delete('instituciones/{institucion_id}/{facultad_id}', 'FacultadController@destroy')->name('facultades.destroy');

    // cursos
    Route::get('instituciones/{institucion}/{facultad}/getCursos', 'CursoController@getCursos')->name('cursos.getCursos');
    Route::post('instituciones/{institucion}/{facultad}/create', 'CursoController@create')->name('cursos.create');
    Route::get('instituciones/{institucion}/{facultad}/{curso}/getCurso', 'CursoController@getCurso')->name('cursos.getCurso');
    Route::put('instituciones/{institucion}/{facultad}/{curso}', 'CursoController@update')->name('cursos.update');
    Route::delete('instituciones/{institucion}/{facultad}/{curso}', 'CursoController@destroy')->name('cursos.destroy');
    Route::get('instituciones/{institucion}/{facultad}/{curso}', 'CursoController@show')->name('cursos.show');

    // docentes
    Route::get('instituciones/{institucion}/{facultad}/{curso}/getDocentes', 'DocenteController@getDocentes')->name('docentes.getDocentes');
    Route::post('instituciones/{institucion}/{facultad}/{curso}', 'DocenteController@store')->name('docentes.store');
    Route::get('instituciones/{institucion}/{facultad}/{curso}/{docente}/getDocente', 'DocenteController@getDocente')->name('docentes.getDocente');
    Route::put('instituciones/{institucion}/{facultad}/{curso}/{docente}', 'DocenteController@update')->name('docetes.update');
    Route::delete('instituciones/{institucion}/{facultad}/{curso}/{docente}', 'DocenteController@destroy')->name('docetes.destroy');

    // tipo_clientes
    Route::resource('tipos', 'TipoController');

    // tipo_trabajos
    Route::resource('categorias', 'CategoriaController');

    Route::get('facultades/{facultad}', 'FacultadController@getCursos')->name('facultades.getCursos');

    Route::get('cursos/{curso}', 'CursoController@getDocentes')->name('cursos.getDocentes');
    Route::get('cursos', 'CursoController@cursos')->name('cursos.cursos');

    // trabajos
    Route::post('trabajos', 'TrabajoController@store')->name('trabajos.store');
    Route::get('trabajos', 'TrabajoController@index')->name('trabajos.index');
    Route::get('trabajos/getTrabajos', 'TrabajoController@getTrabajos')->name('trabajos.getTrabajos');
    Route::put('trabajos/{trabajo}/anular', 'TrabajoController@anular')->name('trabajos.anular');
    Route::get('trabajos/{trabajo}/getTrabajo', 'TrabajoController@getTrabajo')->name('trabajos.getTrabajo');
    Route::get('trabajos/{curso}/getFacultad', 'TrabajoController@getFacultad')->name('trabajos.getFacultad');
    Route::get('trabajos/clientes/{cliente}/getFacultad', 'TrabajoController@getFacu')->name('trabajos.getFacu');
    Route::put('trabajos/{trabajo}', 'TrabajoController@update')->name('trabajos.update');

    // asignar
    Route::put('trabajos/{trabajo}/asignar/{user}', 'TrabajoController@asignar')->name('trabajos.asignar');
    Route::get('trabajos/asignados', 'TrabajoController@asignados')->name('trabajos.asignados');
    Route::get('trabajos/asignados/{id}/modificar', 'TrabajoController@modificar')->name('trabajos.modificar');
    Route::put('trabajos/asignados/{id}/desarrollador', 'TrabajoController@desarrollador')->name('trabajos.desarrollador');
    Route::get('trabajos/mis_asignados', 'TrabajoController@mis_asignados')->name('trabajos.mis_asignados');
    Route::get('trabajos/mis_asignados/culminar/{id}', 'TrabajoController@culminar')->name('trabajos.culminar');
    Route::put('trabajos/mis_asignados/finalizar/{id}', 'TrabajoController@finalizar')->name('trabajos.finalizar');
    Route::get('trabajos/control', 'TrabajoController@control')->name('trabajos.control');
    Route::put('trabajos/control/aprobar/{id}', 'TrabajoController@aprobar')->name('trabajos.aprobar');
    Route::get('trabajos/control/{id}/devolver', 'TrabajoController@devolver')->name('trabajos.devolver');
    Route::put('trabajos/control/{id}/entregar', 'TrabajoController@entregar')->name('trabajos.entregar');
    Route::get('trabajos/salida', 'TrabajoController@salida')->name('trabajos.salida');
    Route::get('trabajos/darSalida/{id}', 'TrabajoController@darSalida')->name('trabajos.darSalida');
    Route::put('trabajos/enviar/{id}', 'TrabajoController@enviar')->name('trabajos.enviar');

    Route::get('trabajos/enviados', 'TrabajoController@enviados')->name('trabajos.enviados');

    // envios
    Route::resource('envios', 'EnvioController');

    // subs
    Route::resource('subs', 'SubController');

    // salidas
    Route::get('salidas/sin_cobrar', 'SalidaController@sin_cobrar')->name('salidas.sin_cobrar');
    Route::get('salidas/{id}/cobrar', 'SalidaController@cobrar')->name('salidas.cobrar');
    Route::post('salidas/{id}/cobrar', 'SalidaController@comprobantes')->name('comprobantes.cobrar');
    Route::get('salidas/cobradas', 'SalidaController@cobradas')->name('salidas.cobradas');

    // comprobantes
    Route::get('salidas/{id}/mostrar', 'ComprobanteController@show')->name('comprobantes.show');
    Route::get('comprobantes/{id}/edit', 'ComprobanteController@edit')->name('comprobantes.edit');
    Route::put('comprobantes/{id}', 'ComprobanteController@update')->name('comprobantes.update');
    Route::delete('comprobantes/{id}', 'ComprobanteController@destroy')->name('comprobantes.destroy');

    // pagos
    Route::resource('pagos', 'PagoController');

    // cuentas
    Route::resource('cuentas', 'CuentaController');

});