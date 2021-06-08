<?php

use App\HistorialCriptomoneda;
use App\HistorialCompleto;
use App\Criptomoneda;
use Carbon\Carbon;

//Estas estan aqui arriba porque fallan si las ponemos abajo
Route::get('/foro/nuevo', 'ForoController@create');



//Home, Inicio o Dashboards
Route::get('/', 'InicioController@index');
Route::get('/home', 'HomeController@index')->name('home');


//Rutas de las criptomonedas
Route::get('/criptomonedas', 'CriptomonedaController@index')->name('criptomonedas');
Route::get('/criptomonedas/{nombre}', 'CriptomonedaController@show');
Route::get('/historyall/{id}', function(Request $request , $id){

    $json = array();

    $criptomonedas = HistorialCriptomoneda::where('id_criptomoneda', $id)->get();
    // dd($criptomonedas->first());
    foreach($criptomonedas as $criptomoneda){
        //dd($criptomoneda);

        $precio = (int) $criptomoneda->precio_dolar;
        $fecha = Carbon::createFromTimeString($criptomoneda->fecha, 'Europe/Madrid')->getTimestamp()*1000;
        $json2 = array($fecha,$precio);
        array_push($json, $json2);
        //dd($precio);

    }

    return response()->json($json);
});
Route::get('/historiall/{id}', function(Request $request , $id){

    $criptomonedas = HistorialCriptomoneda::where('id_criptomoneda', $id)->get();

    return response()->json($criptomonedas);
});


//Interacciones del usuario con la criptomoneda
Route::get('/valor/{id}', function(Request $request , $id){

    $criptomoneda = HistorialCriptomoneda::where('id_criptomoneda', $id)->get()->last();

    return response()->json($criptomoneda);
});

Route::put('/criptomonedas/{id}/valorar' , 'CriptomonedaController@valorar');
Route::put('/criptomonedas/{id}/desvalorar' , 'CriptomonedaController@desvalorar');


Route::put('/criptomonedas/{id}/comentario' , 'CriptomonedaController@comentario')
    ->name("comentariocriptomoneda");

Route::put('/criptomonedas/{id}/favorito' , 'CriptomonedaController@favorito');
Route::put('/criptomonedas/{id}/desfavorito' , 'CriptomonedaController@desfavorito');


Route::delete("/criptomonedas/(id)", 'CriptomonedaController@eliminarcomentario')
    ->name("eliminarcomentariocriptomoneda");

//Rutas del foro
Route::get('/foro' , 'ForoController@index')->name("foro");
Route::get('/foro/{id}' , 'ForoController@show')->name("entrada");



/*Route::get('/foro/nuevo', 'ForoController@create')
    ->name("new");*/



//Foro con Usuarios

Route::post('/foro/crear', 'ForoController@store');
Route::get('/usuarios', 'UserController@index')->name("usuarios");
Route::put('/entradas/valorar', 'ForoController@valorar');
Route::put('/foro/{id}/desvalorar' , 'ForoController@desvalorar');
Route::put('/foro/{id}/valorar' , 'ForoController@valorar');
Route::put('/foro/{id}/comentario' , 'ForoController@comentario')->name("comentarioentrada");
Route::delete("/foro/(id)", 'ForoController@eliminarcomentario')->name("eliminarcomentarioentrada");

Route::get('/foro/{id}/editar' , 'ForoController@update')->name("editarentrada");
Route::put('/foro/editar', 'ForoController@editar');

//Rutas de autorizacion
Auth::routes();

//Rutas de usuario
Route::get('/nuevousuario', 'UserController@create')->name("crearusuario");
Route::put('/usuarios/crear', 'UserController@store');
Route::get('/usuarios/{nick}', 'UserController@show')->name("usuario");
Route::get('/usuarios/{nick}/editar', 'UserController@editar')->name("editarusuario");
Route::put('/usuarios/editar', 'UserController@update');

Route::delete("/usuarios/{id}", 'UserController@eliminar')->name("eliminarusuario");


/*Route::get('/prueba', function(){
    return view('prueba2');
});*/


//Route::get('/criptomonedas/{nombre}/editar', 'CriptomonedaController@update');
//Route::put('/criptomonedas/editar', 'CriptomonedaController@editar');


//Route::get('/foro/etiquetas' , 'ForoController@etiquetas')->name("etiquetas");



//Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');

//Recoje el ultimo dato de la API
Route::get('/criptomonedas/{id}/dato', function(Request $request , $id){
    $criptomoneda = HistorialCriptomoneda::where('id_criptomoneda', $id)->get()->last();

    return response()->json($criptomoneda);
});

//Recoje los datos de la api
Route::get('/criptomonedas/{id}/datos', function(Request $request , $id){

    $json = array();

    $criptomonedas = HistorialCriptomoneda::where('id_criptomoneda', $id)->orderBy('fecha', 'desc')->get();
    foreach($criptomonedas as $criptomoneda){


        $precio = (int) $criptomoneda->precio_dolar;
        $fecha = Carbon::createFromTimeString($criptomoneda->fecha, 'Europe/Madrid')->getTimestamp()*1000;

        $json2 = array($fecha,$precio);
        array_push($json, $json2);
    }

    //dd($json);
    return $json;
});

Route::get('/historyall/{id}', function(Request $request , $id){

    $json = array();

    $criptomonedas = HistorialCompleto::where('id_criptomoneda', $id)->orderBy('fecha', 'desc')->get();
    foreach($criptomonedas as $criptomoneda){


        $precio = (int) $criptomoneda->precio_dolar;
        $fecha = Carbon::createFromTimeString($criptomoneda->fecha, 'Europe/Madrid')->getTimestamp()*1000;

        $json2 = array($fecha,$precio);
        array_push($json, $json2);
    }

    //dd($json);
    return $json;
});

