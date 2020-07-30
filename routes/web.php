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

    // clientes
    Route::get('clientes', 'ClienteController@index')->name('clientes.index')->middleware('permission:listar clientes');
    Route::get('clientes/getClientes', 'ClienteController@getClientes')->name('clientes.getClientes');
    Route::get('clientes/instituciones/{id}', 'ClienteController@getFacultades')->name('clientes.getFacultades');
    Route::post('clientes', 'ClienteController@store')->name('clientes.store')->middleware('permission:crear cliente');
    Route::get('clientes/{id}', 'ClienteController@edit')->name('clientes.edit')->middleware('permission:editar cliente');
    Route::put('clientes/{id}', 'ClienteController@update')->name('clientes.update')->middleware('permission:editar cliente');
    Route::delete('clientes/{id}', 'ClienteController@destroy')->name('clientes.destroy')->middleware('permission:eliminar cliente');

    // usuarios
    Route::get('usuarios', 'UserController@index')->name('usuarios.index')->middleware('permission:listar usuarios');
    Route::post('usuarios', 'UserController@store')->name('usuarios.store')->middleware('permission:crear usuario');
    Route::get('usuarios/{id}/edit', 'UserController@edit')->name('usuarios.edit')->middleware('permission:editar usuario');
    Route::delete('usuarios/{id}', 'UserController@destroy')->name('usuarios.destroy')->middleware('permission:eliminar usuario');
    Route::get('usuarios/create', 'UserController@create')->name('usuarios.create')->middleware('permission:crear usuario');
    Route::put('usuarios/{id}', 'UserController@update')->name('usuarios.update')->middleware('permission:editar usuario');

    // trabajos
    Route::post('trabajos', 'TrabajoController@store')->name('trabajos.store')->middleware('permission:asignar trabajo');
    Route::get('trabajos', 'TrabajoController@index')->name('trabajos.index')->middleware('permission:listar trabajos-sin-asignar');
    Route::get('trabajos/getTrabajos', 'TrabajoController@getTrabajos')->name('trabajos.getTrabajos');
    Route::put('trabajos/{trabajo}/anular', 'TrabajoController@anular')->name('trabajos.anular')->middleware('permission:anular trabajo-sin-asignar');
    Route::get('trabajos/{trabajo}/getTrabajo', 'TrabajoController@getTrabajo')->name('trabajos.getTrabajo');
    Route::get('trabajos/{curso}/getFacultad', 'TrabajoController@getFacultad')->name('trabajos.getFacultad');
    Route::get('trabajos/clientes/{cliente}/getFacultad', 'TrabajoController@getFacu')->name('trabajos.getFacu');
    Route::put('trabajos/{trabajo}', 'TrabajoController@update')->name('trabajos.update')->middleware('permission:editar trabajo-sin-asignar');

    // asignar
    Route::put('trabajos/{trabajo}/asignar/{user}', 'TrabajoController@asignar')->name('trabajos.asignar')->middleware('permission:asignar trabajo');
    Route::get('trabajos/asignados', 'TrabajoController@asignados')->name('trabajos.asignados')->middleware('permission:listar trabajos-asignados');
    Route::get('trabajos/asignados/{id}/modificar', 'TrabajoController@modificar')->name('trabajos.modificar')->middleware('permission:asignar trabajo');
    Route::put('trabajos/asignados/{id}/desarrollador', 'TrabajoController@desarrollador')->name('trabajos.desarrollador')->middleware('permission:asignar trabajo');
    Route::get('trabajos/mis_asignados', 'TrabajoController@mis_asignados')->name('trabajos.mis_asignados')->middleware('permission:listar mis-trabajos-asignados');
    Route::get('trabajos/mis_asignados/culminar/{id}', 'TrabajoController@culminar')->name('trabajos.culminar')->middleware('permission:culminar mi-trabajo-asignado');
    Route::put('trabajos/mis_asignados/finalizar/{id}', 'TrabajoController@finalizar')->name('trabajos.finalizar')->middleware('permission:culminar mi-trabajo-asignado');
    Route::get('trabajos/control', 'TrabajoController@control')->name('trabajos.control')->middleware('permission:listar trabajos-control-calidad');
    Route::put('trabajos/control/aprobar/{id}', 'TrabajoController@aprobar')->name('trabajos.aprobar')->middleware('permission:aprobar trabajos-control-calidad');
    Route::get('trabajos/control/{id}/devolver', 'TrabajoController@devolver')->name('trabajos.devolver')->middleware('permission:devolver trabajos-control-calidad');
    Route::put('trabajos/control/{id}/entregar', 'TrabajoController@entregar')->name('trabajos.entregar')->middleware('permission:devolver trabajos-control-calidad');
    Route::get('trabajos/salida', 'TrabajoController@salida')->name('trabajos.salida')->middleware('permission:listar trabajos-para-salida');
    Route::get('trabajos/darSalida/{id}', 'TrabajoController@darSalida')->name('trabajos.darSalida')->middleware('permission:dar salida-trabajo');
    Route::put('trabajos/enviar/{id}', 'TrabajoController@enviar')->name('trabajos.enviar')->middleware('permission:dar salida-trabajo');

    Route::get('trabajos/enviados', 'TrabajoController@enviados')->name('trabajos.enviados')->middleware('permission:listar trabajos-enviados');

    // salidas
    Route::get('salidas/sin_cobrar', 'SalidaController@sin_cobrar')->name('salidas.sin_cobrar')->middleware('permission:listar salidas-sin-cobrar');
    Route::get('salidas/{id}/cobrar', 'SalidaController@cobrar')->name('salidas.cobrar')->middleware('permission:cobrar salidas-sin-cobrar');
    Route::post('salidas/{id}/cobrar', 'SalidaController@comprobantes')->name('comprobantes.cobrar')->middleware('permission:cobrar salidas-sin-cobrar');
    Route::get('salidas/cobradas', 'SalidaController@cobradas')->name('salidas.cobradas')->middleware('permission:listar salidas-cobradas');

    // comprobantes
    Route::get('salidas/{id}/mostrar', 'ComprobanteController@show')->name('comprobantes.show')->middleware('permission:ver-archivos salidas-cobradas');
    Route::get('comprobantes/{id}/edit', 'ComprobanteController@edit')->name('comprobantes.edit')->middleware('permission:ver-archivos salidas-cobradas');
    Route::put('comprobantes/{id}', 'ComprobanteController@update')->name('comprobantes.update')->middleware('permission:ver-archivos salidas-cobradas');
    Route::delete('comprobantes/{id}', 'ComprobanteController@destroy')->name('comprobantes.destroy')->middleware('permission:ver-archivos salidas-cobradas');

    // FROM HERE USES THE ROLE:ADMIN
    Route::group(['middleware' => ['role:admin']], function () {

    // resource grupos
    Route::resource('grupos', 'GrupoController');

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

    Route::get('facultades/{facultad}', 'FacultadController@getCursos')->name('facultades.getCursos');

    Route::get('cursos/{curso}', 'CursoController@getDocentes')->name('cursos.getDocentes');
    Route::get('cursos', 'CursoController@cursos')->name('cursos.cursos');

    // tipo_clientes
    Route::resource('tipos', 'TipoController');

    // tipo_trabajos
    Route::resource('categorias', 'CategoriaController');

    // subs
    Route::resource('subs', 'SubController');

    // envios
    Route::resource('envios', 'EnvioController');

    // pagos
    Route::resource('pagos', 'PagoController');

    // cuentas
    Route::resource('cuentas', 'CuentaController');

    // roles
    Route::get('roles', 'RoleController@index')->name('roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create');
    Route::post('roles', 'RoleController@store')->name('roles.store');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy');

    // usuarios - roles
    Route::get('usuarios/{id}', 'UserController@show')->name('usuarios.show');
    Route::post('usuarios/{id}/roles', 'UserController@roles')->name('usuarios.roles');

    });
    // END MIDDLEWARE

});