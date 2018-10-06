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

/*
 * Landing Routes...
 */
Route::get('/', 'LandingController@index')->name('index');
Route::get('eventos-vigentes', 'LandingController@eventos')->name('landing.eventos');

/*
 * Authentication Routes...
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/*
 * Password Reset Routes..
 */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*
 * Home Routes...
 */
Route::get('/inicio', 'HomeController@index')->name('inicio');

/*
 * Acudientes Routes...
 */
Route::resource('acudientes', 'AcudienteController');

/*
 * Acudientes Routes Ajax...
 */
Route::get('acudientes/buscar', 'AcudienteController@search')->name('acudientes.search');

/*
 * Administrativos Routes...
 */
Route::resource('administrativos', 'AdministrativoController')->except(['destroy']);

/*
 * Alumnos Routes...
 */
Route::resource('alumnos', 'AlumnoController');

/*
 * Areas Routes...
 */
Route::resource('areas', 'AreaController')->except(['show', 'destroy']);

/*
 * Asignaturas Routes...
 */
Route::resource('asignaturas', 'AsignaturaController')->except(['destroy']);

/*
 * Asignaturas fechas Routes...
 */
Route::resource('asignaturas.fechas', 'AsignaturaFechaController')->except(['destroy']);

/*
 * Asistencias Routes...
 */
Route::resource('asistencias', 'AsistenciaController');

/*
 * Bitacoras Routes...
 */
Route::resource('bitacoras', 'BitacoraController')->only(['index']);

/*
 * Calendarios Routes...
 */
Route::resource('calendarios', 'CalendarioController')->except(['show', 'create', 'edit']);

/*
 * Calendarios Routes Ajax...
 */
Route::get('calendarios/eventos', 'CalendarioController@event')->name('calendarios.event');

/*
 * Docentes Routes...
 */
Route::resource('docentes', 'DocenteController')->except(['destroy']);

/*
 * Empleados Routes...
 */
Route::resource('empleados', 'EmpleadoController')->except(['destroy']);

/*
 * Estudiantes Routes...
 */
Route::resource('estudiantes', 'EstudianteController');

/*
 * Estudiantes Routes Descargar...
 */
Route::get('estudiantes/{estudiante}/{campo}/download', 'EstudianteController@download')->name('estudiantes.download');

/*
 * Estudiantes Implementos Routes...
 */
Route::apiResource('estudiantes.implementos', 'EstudianteImplementoController')->except(['show', 'update']);

/*
 * Eventos Routes...
 */
Route::resource('eventos', 'EventoController');

/*
 * Fechas Routes...
 */
Route::resource('fechas', 'FechaController')->except(['destroy']);

/*
 * Galerias Routes...
 */
Route::resource('galerias', 'GaleriaController')->except(['show']);

/*
 * Grados Routes...
 */
Route::resource('grados', 'GradoController')->except(['destroy']);

/*
 * SubGrados Routes...
 */
Route::resource('grados.subgrados', 'SubGradoController')->except(['index', 'show', 'destroy']);

/*
 * SubGrados Asignaturas Routes Ajax...
 */
Route::get('subgrados/{subgrado}/asignaturas', 'SubGradoController@asignatura')->name('subgrados.asignaturas');

/*
 * Implementos Routes...
 */
Route::resource('implementos', 'ImplementoController');

/*
 * Inventarios Routes...
 */
Route::resource('inventarios', 'InventarioController')->only(['index']);

/*
 * Mesas Routes...
 */
Route::resource('mesas', 'MesaController');

/*
 * Nominas Routes...
 */
Route::resource('nominas', 'NominaController');

/*
 * Notas Routes...
 */
Route::resource('notas', 'NotaController');

/*
 * Pagos Routes...
 */
Route::resource('pagos', 'PagoController');

/*
 * Planeamientos Routes...
 */
Route::resource('planeamientos', 'PlaneamientoController');

/*
 * Planeamientos Download Routes...
 */
Route::get('planeamientos/{planeamiento}/download', 'PlaneamientoController@download')->name('planeamientos.download');

/*
 * Practicantes Routes...
 */
Route::resource('practicantes', 'PracticanteController')->except(['destroy']);

/*
 * programas Routes...
 */
Route::resource('programas', 'ProgramaController')->except(['show']);

/*
 * Roles Routes...
 */
Route::resource('roles', 'RoleController');

/*
 * Salidas Routes...
 */
Route::resource('salidas', 'SalidaController');

/*
 * Seguimientos Routes...
 */
Route::resource('seguimientos', 'SeguimientoController')->except(['destroy']);

/*
 * Tipo Empleados Routes...
 */
Route::resource('tipoempleados', 'TipoEmpleadoController');

/*
 * Usuarios Routes...
 */
Route::resource('usuarios', 'UsuarioController')->except(['create', 'store']);