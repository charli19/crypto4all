<?php

namespace App\Http\Controllers;
use App\Entrada;
use App\ComentarioEntrada;
use App\ValorEntrada;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForoController extends Controller
{
    //Ver entradas
    public function index()
    {

        $entradas = Entrada::orderBy('id_entrada','desc')->get();


        $title="Foro";

        //dd(compact('entrada','title'));

        return view('foro.foro', compact('entradas','title'));
    }
    //Ver entrada
    public function show($id)
    {

        $entrada = Entrada::findOrFail($id);

        //$entrada->comentarioEntrada()->get();

        return view('foro.entrada', compact('entrada'));
    }
    //Ir al form para crear entrada
    public function create()
    {

        return view('Foro.create');
    }
    //Crear entrada
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => ['required'],
            'texto' => ['required'],
            'id_usuario' => ['required'],

        ]);
        $fecha = Carbon::now(new DateTimeZone('Europe/Madrid'));
        $fecha = $fecha->format('Y-m-d H:m:s');
        $entrada = Entrada::create([
            'titulo' => $request['titulo'],
            'texto' => $request['texto'],
            'etiquetas' => $request['etiquetas'],
            'created_at' => $fecha,
            'id_usuario' => $request['id_usuario'],


        ]);
        $entrada->created_at = $fecha;
        $entrada->save();

        return redirect()->route("foro");
    }


    //Ir al form para editar entrada
    public function update(Request $request, $id_entrada)
    {

        $entrada = Entrada::find($id_entrada);

        return view('foro.editar', compact('entrada'));

    }


    //Editar entrada
    public function editar(Request $request)
    {

        $this->validate($request, [
            'titulo' => ['required'],
            'texto' => ['required'],
            'id_usuario' => ['required'],

        ]);


        $entrada = Entrada::find($request->id);

        $entrada->fill($request->all());
        $entrada->save();


        return redirect()->route("foro");

    }



    public function valorar(Request $request)
    {

        $this->validate($request, [
            'id_usuario' => ['required'],
            'id_entrada' => ['required'],
            'valor' => ['required'],

        ]);

        ValorEntrada::create([
            'id_usuario' => $request['id_usuario'],
            'id_entrada' => $request['id_entrada'],
            'valor' => $request['valor'],

        ]);


        return redirect()->back();
    }

    public function desvalorar(Request $request)
    {

        $valor = ValorEntrada::where('id_entrada',"$request->id_entrada")->where('id_usuario',"$request->id_usuario");
        $valor->delete();
        return back();

    }




    //Crea comentario en entrada en la que estes y con el usuario identificado
    public function comentario(Request $request)
    {
        $this->validate($request, [
            'id_usuario' => ['required'],
            'id_entrada' => ['required'],
            'comentario' => ['required'],

        ]);

        ComentarioEntrada::create([
            'id_usuario' => $request['id_usuario'],
            'id_entrada' => $request['id_entrada'],
            'comentario' => $request['comentario'],
        ]);

        return redirect()->back();

    }
    //Elimina
    public function eliminarcomentario(Request $request)
    {

        $comentario = ComentarioEntrada::find($request->id_comentario);
        $comentario->delete();
        return back();
    }




    //Ver entradas
    public function etiquetas()
    {

        $entradas = Entrada::all();


        $title="Foro";

        //dd(compact('entrada','title'));

        return view('foro.etiquetas', compact('entradas','title'));
    }


}
