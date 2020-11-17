<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route :: group ([ 'middleware' => 'web' ], function () {
    //Route::get('/', 'Controller@index');
    //Route::get ( '/login/logout' , [ 'as' => 'login.logout' , 'usa' => 'LoginController@logout' ]);

});

//////--------ROTAS DE PACIENTE ----------///////

Route :: group ([ 'middleware' => 'patient' ], function () {
    Route :: group ([ 'middleware' => 'auth:patient' ], function (){
   
    });
    
    Route::get('/homepage-paciente', 'AgendamentosController@homepagePaciente' );
    Route::get('/',['as'=>'login.index','uses'=>'LoginController@index']);
    Route::post('/login/postLogin',['as'=>'login.postLogin','uses'=>'LoginController@postLogin']);

    Route::get('homepage-paciente/logout', 'LoginController@logout');

    Route::get('/homepage-paciente/meus-dados', 'Controller@dadosPaciente' );
    Route::get('/homepage-paciente/meus-dados/editar', 'PatientsController@editar'{id})->name('patient.editar');
});

//////--------ROTAS DE SECRETARIA ----------///////

Route :: group ([ 'middleware' => 'secretaria' ], function () {
    Route :: group ([ 'middleware' => 'auth:secretaria' ], function (){

    });
    // $value = session('key');
    Route::get('/homepage-Secretaria', 'AnamnesesController@homepageSecretaria')->name('secretaria.homepage');

    Route::get('/',['as'=>'login.index','uses'=>'LoginController@index']);
    Route::post('/login/postLogin',['as'=>'login.postLogin','uses'=>'LoginController@postLogin']);
    Route::get('homepage-Secretaria/logout', 'LoginController@logout');

    Route::get('/homepage-Secretaria/agendamentos', 'AgendamentosController@show');
    Route::get('/homepage-Secretaria/pacientes', 'PatientsController@show');
    Route::get('/homepage-Secretaria/novo-agendamento', 'AgendamentosController@novoAgendamento');
    Route::get('/homepage-Secretaria/novo-paciente', 'PatientsController@novoPaciente');
    Route::get('/homepage-Secretaria/nova-anamnese', 'AnamnesesController@novaAnamnese');
});


//////--------ROTAS DE MEDICO ----------///////

Route :: group ([ 'middleware' => 'doctor' ], function () {
    Route :: group ([ 'middleware' => 'auth:doctor' ], function (){

    });

    Route::get('/homepage-medico', 'AnamnesesController@homepageMedico')->name('doctor.homepage');

    Route::get('/',['as'=>'login.index','uses'=>'LoginController@index']);
    Route::post('/login/postLogin',['as'=>'login.postLogin','uses'=>'LoginController@postLogin']);
    Route::get('homepage-medico/logout', 'LoginController@logout');

    Route::get('/homepage-medico/agendamentos', 'AgendamentosController@showMedico');
    Route::get('/homepage-medico/nova-anamnese', 'AnamnesesController@novaAnamneseMedico');
});


//////--------ROTAS DE ENFERMEIRO ----------///////

Route :: group ([ 'middleware' => 'enfermeiro' ], function () {
    Route :: group ([ 'middleware' => 'auth:enfermeiro' ], function (){

    });

    Route::get('/homepage-enfermeiro', 'AnamnesesController@homepageEnfermeiro')->name('enfermeiro.homepage');
    
    Route::get('/',['as'=>'login.index','uses'=>'LoginController@index']);
    Route::post('/login/postLogin',['as'=>'login.postLogin','uses'=>'LoginController@postLogin']);
    Route::get('homepage-enfermeiro/logout', 'LoginController@logout');

    Route::get('/homepage-enfermeiro/agendamentos', 'AgendamentosController@showEnfermeiro');
    Route::get('/homepage-enfermeiro/nova-anamnese', 'AnamnesesController@novaAnamneseEnfermeiro');

});

//////--------ROTAS DE USER E ADM ----------///////

Route :: group ([ 'middleware' => 'user' ], function () {
    Route :: group ([ 'middleware' => 'auth:user' ], function (){

    });

    Route::get('/homepage-user', 'Controller@homepageUser')->name('user.index');
    Route::get('/',['as'=>'login.index','uses'=>'LoginController@index']);
    Route::post('/login/postLogin',['as'=>'login.postLogin','uses'=>'LoginController@postLogin']);

    Route::get('homepage-user/logout', 'LoginController@logout');
});




//Auth::routes();

//Route::get('/home', 'LoginController@index')->name('home');
Route::get('/cadastros', 'UsersController@dashboard')->name('admin');
//Route::get('/admin/login', 'UsersController@login')->name('admin.login');

Auth::routes();

Route::resource('/user', 'UsersController');

Route::resource('/psf', 'PsfsController');

Route::resource('/doctor', 'DoctorsController');

Route::resource('/availability', 'AvailabilitiesController');

Route::resource('/patient', 'PatientsController');

Route::resource('/enfermeiro', 'EnfermeirosController');

Route::resource('/agendamentos', 'AgendamentosController');

Route::resource('/secretaria', 'SecretariasController');

Route::resource('/anamnese', 'AnamnesesController');

//Route::get('/homepage-Secretaria', 'Controller@homepageSecretaria')->name('secretaria.homepage');
//Route::get('/homepage-enfermeiro', 'Controller@homepageEnfermeiro')->name('enfermeiro.homepage');
//Route::get('/homepage-medico', 'Controller@homepageMedico')->name('doctor.homepage');
//Route::get('/homepage-paciente', 'AgendamentosController@homepagePaciente')->name('patient.homepage');
// Route::get('/availability/ajaxcall', 'AvailabilitiesController@ajaxcall');
// Route::get('/availability/ajaxcall', ['as' => 'availability.ajaxcall', 'uses' => 'AvailabilitiesController@ajaxcall']);

Route::resource('/Secretaria', 'SecretariasController');

//Rotas de parte funcional


