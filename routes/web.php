<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/user', 'usersController@user')->name('user');
    //Route::get('/admin', 'adminController@admin')->name('admin');
    Route::get('/home', 'HomeController@index')->name('home');

    //usuarios
    Route::get('/listarUsuarios', 'UsuariosController@admin')->name('listarusuarios');
    Route::post('/selectdata', 'UsuariosController@selectdata')->name('selectdata');
    Route::post('/insertdata', 'UsuariosController@insertdata')->name('insertdata');
    Route::post('/deletedata', 'UsuariosController@deletedata')->name('deletedata');
    Route::post('/updatedata', 'UsuariosController@updatedata')->name('updatedata');
    Route::post('/getEditarData', 'UsuariosController@getEditarData')->name('getEditarData');

    //jefes
    Route::get('/listarJefes', 'JefesController@admin')->name('jefes');
    Route::post('/selectdatajefes', 'JefesController@selectdatajefes')->name('selectdatajefes');
    Route::post('/insertdatajefes', 'JefesController@insertdatajefes')->name('insertdatajefes');
    Route::post('/deletedatajefes', 'JefesController@deletedatajefes')->name('deletedatajefes');
    Route::post('/updatedatajefes', 'JefesController@updatedatajefes')->name('updatedatajefes');
    Route::post('/getEditarDatajefes', 'JefesController@getEditarDatajefes')->name('getEditarDatajefes');


    //socios
    Route::get('/listarSocios', 'SociosController@admin')->name('socios');
    Route::post('/selectdataSocios', 'SociosController@selectdataSocios')->name('selectdataSocios');
    Route::post('/insertdataSocios', 'SociosController@insertdataSocios')->name('insertdataSocios');
    Route::post('/deletedataSocios', 'SociosController@deletedataSocios')->name('deletedataSocios');
    Route::post('/updatedataSocios', 'SociosController@updatedataSocios')->name('updatedataSocios');
    Route::post('/getEditarDataSocios', 'SociosController@getEditarDataSocios')->name('getEditarDataSocios');


    //personal
    Route::get('/listarPersonal', 'PersonalController@admin')->name('personal');
    Route::post('/selectdataPersonal', 'PersonalController@selectdataPersonal')->name('selectdataPersonal');
    Route::post('/insertdataPersonal', 'PersonalController@insertdataPersonal')->name('insertdataPersonal');
    Route::post('/deletedataPersonal', 'PersonalController@deletedataPersonal')->name('deletedataPersonal');
    Route::post('/updatedataPersonal', 'PersonalController@updatedataPersonal')->name('updatedataPersonal');
    Route::post('/getEditarDataPersonal', 'PersonalController@getEditarDataPersonal')->name('getEditarDataPersonal');


    //recepcion
    Route::get('/listarRecepcion', 'RecepcionController@admin')->name('recepcion');
    Route::post('/selectdataRecepcion', 'RecepcionController@selectdataRecepcion')->name('selectdataRecepcion');
    Route::post('/insertdataRecepcion', 'RecepcionController@insertdataRecepcion')->name('insertdataRecepcion');
    Route::post('/deletedataRecepcion', 'RecepcionController@deletedataRecepcion')->name('deletedataRecepcion');
    Route::post('/updatedataRecepcion', 'RecepcionController@updatedataRecepcion')->name('updatedataRecepcion');
    Route::post('/getEditarDataRecepcion', 'RecepcionController@getEditarDataRecepcion')->name('getEditarDataRecepcion');

    //gimnasios
    Route::get('/listarGimnasios', 'GimnasioController@admin')->name('gimnasio');
    Route::post('/selectdatagimnasio', 'GimnasioController@selectdatagimnasio')->name('selectdatagimnasio');
    Route::post('/insertdatagimnasio', 'GimnasioController@insertdatagimnasio')->name('insertdatagimnasio');
    Route::post('/deletedatagimnasio', 'GimnasioController@deletedatagimnasio')->name('deletedatagimnasio');
    Route::post('/updatedatagimnasio', 'GimnasioController@updatedatagimnasio')->name('updatedatagimnasio');
    Route::post('/getEditarDatagimnasio', 'GimnasioController@getEditarDatagimnasio')->name('getEditarDatagimnasio');


    //clase
    Route::get('/listarClase', 'ClasesController@admin')->name('clase');
    Route::post('/selectdataClase', 'ClasesController@selectdataClase')->name('selectdataClase');
    Route::post('/insertdataClase', 'ClasesController@insertdataClase')->name('insertdataClase');
    Route::post('/deletedataClase', 'ClasesController@deletedataClase')->name('deletedataClase');
    Route::post('/updatedataClase', 'ClasesController@updatedataClase')->name('updatedataClase');
    Route::post('/getEditarDataClase', 'ClasesController@getEditarDataClase')->name('getEditarDataClase');


    //sala
    Route::get('/listarSala', 'SalaController@admin')->name('sala');
    Route::post('/selectdataSala', 'SalaController@selectdataSala')->name('selectdataSala');
    Route::post('/insertdataSala', 'SalaController@insertdataSala')->name('insertdataSala');
    Route::post('/deletedataSala', 'SalaController@deletedataSala')->name('deletedataSala');
    Route::post('/updatedataSala', 'SalaController@updatedataSala')->name('updatedataSala');
    Route::post('/getEditarDataSala', 'SalaController@getEditarDataSala')->name('getEditarDataSala');


    //HorarioClase
    Route::get('/listarHorarioClase', 'HorarioClasesController@admin')->name('horarioclases');
    Route::post('/selectdataHorarioClase', 'HorarioClasesController@selectdataHorarioClase')->name('selectdataHorarioClase');
    Route::post('/insertdataHorarioClase', 'HorarioClasesController@insertdataHorarioClase')->name('insertdataHorarioClase');
    Route::post('/deletedataHorarioClase', 'HorarioClasesController@deletedataHorarioClase')->name('deletedataHorarioClase');
    Route::post('/updatedataHorarioClase', 'HorarioClasesController@updatedataHorarioClase')->name('updatedataHorarioClase');
    Route::post('/getEditarDataHorarioClase', 'HorarioClasesController@getEditarDataHorarioClase')->name('getEditarDataHorarioClase');
    Route::post('/getEditarDataGimnasioSalaClaseMonitores', 'HorarioClasesController@getEditarDataGimnasioSalaClaseMonitores')->name('getEditarDataGimnasioSalaClaseMonitores');



    //Calendario Horario de las Clases
    Route::get('/CalendarioHorarioClase', 'CalendarioHorarioClasesController@admin')->name('CalendarioHorarioClase');
    Route::get('/CalendarioHorarioClaseGETDATA', 'CalendarioHorarioClasesController@CalendarioHorarioClaseGETDATA')->name('CalendarioHorarioClaseGETDATA');
    Route::post('/inscribeClaseMatriculadaGETDATA', 'CalendarioHorarioClasesController@inscribeClaseMatriculadaGETDATA')->name('inscribeClaseMatriculadaGETDATA');
    Route::post('/insertClaseMatriculada', 'CalendarioHorarioClasesController@insertClaseMatriculada')->name('insertClaseMatriculada');
    Route::post('/deletedataClaseMatriculada', 'CalendarioHorarioClasesController@deletedataClaseMatriculada')->name('deletedataClaseMatriculada');



    //Clases Matriculadas Socio
    Route::get('/ClasesMatriculadas', 'ClasesMatriculadasController@admin')->name('ClasesMatriculadas');
    Route::post('/selectdataClaseMatriculadaGETDATA', 'ClasesMatriculadasController@selectdataClaseMatriculadaGETDATA')->name('selectdataClaseMatriculadaGETDATA');
    Route::post('/deletedataClaseMatriculada', 'ClasesMatriculadasController@deletedataClaseMatriculada')->name('deletedataClaseMatriculada');
    Route::post('/getEditarDataClaseMatriculada', 'ClasesMatriculadasController@getEditarDataClaseMatriculada')->name('getEditarDataClaseMatriculada');
    Route::post('/updatedataHorarioClaseMatriculada', 'ClasesMatriculadasController@updatedataHorarioClaseMatriculada')->name('updatedataHorarioClaseMatriculada');


     //Categoria Ejercicios
    Route::get('/CategoriaEjercicios', 'CategoriasEjerciciosController@admin')->name('CategoriaEjercicios');
    Route::post('/selectdataCategoriaEjercicios', 'CategoriasEjerciciosController@selectdataCategoriaEjercicios')->name('selectdataCategoriaEjercicios');
    Route::post('/insertdataCategoriaEjercicios', 'CategoriasEjerciciosController@insertdataCategoriaEjercicios')->name('insertdataCategoriaEjercicios');
    Route::post('/deletedataCategoriaEjercicios', 'CategoriasEjerciciosController@deletedataCategoriaEjercicios')->name('deletedataCategoriaEjercicios');
    Route::post('/updatedataCategoriaEjercicios', 'CategoriasEjerciciosController@updatedataCategoriaEjercicios')->name('updatedataCategoriaEjercicios');
    Route::post('/getEditarDataCategoriaEjercicios', 'CategoriasEjerciciosController@getEditarDataCategoriaEjercicios')->name('getEditarDataCategoriaEjercicios');


    //Tipo Ejercicios
    Route::get('/TipoEjercicios', 'TiposEjerciciosController@admin')->name('TipoEjercicios');
    Route::post('/selectdataTipoEjercicios', 'TiposEjerciciosController@selectdataTipoEjercicios')->name('selectdataTipoEjercicios');
    Route::post('/insertdataTipoEjercicios', 'TiposEjerciciosController@insertdataTipoEjercicios')->name('insertdataTipoEjercicios');
    Route::post('/deletedataTipoEjercicios', 'TiposEjerciciosController@deletedataTipoEjercicios')->name('deletedataTipoEjercicios');
    Route::post('/updatedataTipoEjercicios', 'TiposEjerciciosController@updatedataTipoEjercicios')->name('updatedataTipoEjercicios');
    Route::post('/getEditarDataTipoEjercicios', 'TiposEjerciciosController@getEditarDataTipoEjercicios')->name('getEditarDataTipoEjercicios');



    //Ejercicios
    Route::get('/Ejercicios', 'EjerciciosController@admin')->name('Ejercicios');
    Route::post('/selectdataEjercicios', 'EjerciciosController@selectdataEjercicios')->name('selectdataEjercicios');
    Route::post('/insertdataEjercicios', 'EjerciciosController@insertdataEjercicios')->name('insertdataEjercicios');
    Route::post('/deletedataEjercicios', 'EjerciciosController@deletedataEjercicios')->name('deletedataEjercicios');
    Route::post('/updatedataEjercicios', 'EjerciciosController@updatedataEjercicios')->name('updatedataEjercicios');
    Route::post('/getEditarDataEjercicios', 'EjerciciosController@getEditarDataEjercicios')->name('getEditarDataEjercicios');


    //Tabla de Ejercicios
    Route::get('/TabladeEjercicios', 'TablasEjerciciosController@admin')->name('TabladeEjercicios');
    Route::post('/selectdataTablaEjercicios', 'TablasEjerciciosController@selectdataTablaEjercicios')->name('selectdataTablaEjercicios');
    Route::post('/insertdataTablaEjercicios', 'TablasEjerciciosController@insertdataTablaEjercicios')->name('insertdataTablaEjercicios');
    Route::post('/updatedataTablaEjercicios', 'TablasEjerciciosController@updatedataTablaEjercicios')->name('updatedataTablaEjercicios');
    Route::post('/getEditarDataTablaEjercicios', 'TablasEjerciciosController@getEditarDataTablaEjercicios')->name('getEditarDataTablaEjercicios');
    Route::post('/deletedataTablaEjercicios', 'TablasEjerciciosController@deletedataTablaEjercicios')->name('deletedataTablaEjercicios');


    //Login y  Pasarela de Pago
    Route::get('checkout','PasareladePagoController@checkout');
    Route::post('checkout','PasareladePagoController@afterpayment')->name('checkout.credit-card');

    //Historial de Pago
    Route::get('/HistorialdePago', 'HistorialdePagoController@admin')->name('HistorialdePago');
    Route::post('/selectdataHistorialdePago', 'HistorialdePagoController@selectdataHistorialdePago')->name('selectdataHistorialdePago');


    //Entrenamiento Diario
    Route::get('/EntrenamientoDiario', 'EntrenamientoDiarioController@admin')->name('EntrenamientoDiario');
    Route::post('/cargarTablaEjercicio', 'EntrenamientoDiarioController@cargarTablaEjercicio')->name('cargarTablaEjercicio');
    Route::post('/selectdataEntrenamientoDiario_tabla1', 'EntrenamientoDiarioController@selectdataEntrenamientoDiario_tabla1')->name('selectdataEntrenamientoDiario_tabla1');
    Route::post('/selectdataEntrenamientoDiario_tabla2', 'EntrenamientoDiarioController@selectdataEntrenamientoDiario_tabla2')->name('selectdataEntrenamientoDiario_tabla2');
    Route::post('/insertdataEntrenamientoDiario', 'EntrenamientoDiarioController@insertdataEntrenamientoDiario')->name('insertdataEntrenamientoDiario');
    Route::post('/updatedataEntrenamientoDiario', 'EntrenamientoDiarioController@updatedataEntrenamientoDiario')->name('updatedataEntrenamientoDiario');
    Route::post('/getEditarDataEntrenamientoDiario', 'EntrenamientoDiarioController@getEditarDataEntrenamientoDiario')->name('getEditarDataEntrenamientoDiario');



});

Auth::routes();


    //Evolución Ejercicios
    Route::get('/EvolucionEjercicios', 'EvolucionEjercicioController@admin')->name('EvolucionEjercicios');
    Route::post('/selectdataEvolucionEjercicios', 'EvolucionEjercicioController@selectdataEvolucionEjercicios')->name('selectdataEvolucionEjercicios');
    
