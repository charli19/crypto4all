<?php

namespace App\Http\Controllers;

use App\Criptomoneda;
use Illuminate\Http\Request;
use App\HistorialCriptomoneda;
use App\ComentarioCriptomoneda;
use App\CriptomonedaFavorita;
use App\ValorCriptomoneda;

class CriptomonedaController extends Controller
{


    //Ver criptomonedas
    public function index()
    {

        $criptomonedas = Criptomoneda::orderBy('precio_btc','desc')->get();


        $title="Criptomonedas";


        return view('criptomonedas.index', compact('criptomonedas','title'));
    }


    //Ver criptomoneda
    public function show($nombre)
    {

        $criptomoneda = Criptomoneda::where('nombre',"$nombre")->get()->first();

        return view('criptomonedas.show', compact('criptomoneda'));
    }


    //Añadir criptomoneda
    /*public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required'],

        ]);

        $criptomoneda = Criptomoneda::create([
            'nombre' => $request['nombre'],


        ]);

        $criptomoneda->save();

        return redirect()->route("criptomonedas");
    }
*/

    //IR al form para editar criptomoneda
    public function update(Request $request, $nombre)
    {

        $criptomoneda = Criptomoneda::where('nombre',$nombre)->get()->first();
        //dd($criptomoneda);
        return view('criptomonedas.editar', compact('criptomoneda'));

    }

    //Editar Criptomoneda
    public function editar(Request $request)
    {
        //

        $this->validate($request, [
            'nombre' => ['required'],
        ]);

        //dd($request);

        $criptomoneda = Criptomoneda::find($request->id);
        $criptomoneda->fill($request->all());
        $criptomoneda->save();


        return redirect()->route("criptomonedas");

    }



    //Valorar Criptomoneda
    public function valorar(Request $request)
    {

        $this->validate($request, [
            'id_usuario' => ['required'],
            'id_criptomoneda' => ['required'],
            'valor' => ['required'],

        ]);

        ValorCriptomoneda::create([
            'id_usuario' => $request['id_usuario'],
            'id_criptomoneda' => $request['id_criptomoneda'],
            'valor' => $request['valor'],

        ]);


        return redirect()->back();
    }

    public function desvalorar(Request $request)
    {

        $valor = ValorCriptomoneda::where('id_criptomoneda',"$request->id_criptomoneda")->where('id_usuario',"$request->id_usuario");
        $valor->delete();
        return back();

    }


    //Crea comentario en entrada en la que estes y con el usuario identificado
    public function comentario(Request $request)
    {
        $this->validate($request, [
            'id_usuario' => ['required'],
            'id_criptomoneda' => ['required'],
            'comentario' => ['required'],

        ]);

        ComentarioCriptomoneda::create([
            'id_usuario' => $request['id_usuario'],
            'id_criptomoneda' => $request['id_criptomoneda'],
            'comentario' => $request['comentario'],
        ]);

        return redirect()->back();

    }
    //Elimina
    public function eliminarcomentario(Request $request)
    {

        $comentario = ComentarioCriptomoneda::find($request->id_comentario);
        $comentario->delete();
        return back();
    }



    public function favorito(Request $request){

        //dd($request);
        $this->validate($request, [
            'id_usuario' => ['required'],
            'id_criptomoneda' => ['required'],

        ]);

        CriptomonedaFavorita::create([
            'id_usuario' => $request['id_usuario'],
            'id_criptomoneda' => $request['id_criptomoneda'],
        ]);
        return redirect()->back();

    }
    public function desfavorito(Request $request){


        $valor = CriptomonedaFavorita::where('id_criptomoneda',"$request->id_criptomoneda")->where('id_usuario',"$request->id_usuario");
        $valor->delete();
        return back();

    }

}
