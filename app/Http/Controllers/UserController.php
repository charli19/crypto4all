<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $title="Usuarios";

        return view('users.index', compact('users','title'));
    }

    public function show($nick)
    {

        $user = User::where('nick',"$nick")->get()->first();

        return view('users.show', compact('user'));
    }

    public function create()
    {
        if(!Auth::guest() || !Auth::user()->hasRole('user')){
            return view('users.create');
        }
        abort(404);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nick' => ['required'],
            'nombre' => ['required'],
            'email' => ['required', 'email', 'unique:users,email',Rule::unique('users')->ignore($request->id)],
            'password' => ['required'],
        ]);

        User::create([
            'nick' => $request['nick'],
            'nombre' => $request['nombre'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect()->route("usuarios");
    }

    public function editar($nick)
    {
        if(!Auth::guest()){
            $user = User::where('nick',"$nick")->get()->first();

            return view('users.edit', compact('user'));
        }
        abort(404);



    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'nick' => ['required'],
            'nombre' => ['required'],
            'apellidos',
            'email' => ['email',Rule::unique('users')->ignore($request->id_usuario)],
            'fecha_nacimiento',
            'imagen',
            'web',
            'facebook',
            'instagram',
            'twitter',
            'google',
            'linkedin',
            'password' => [''],
        ]);

        if($request['password'] != null){
            $request['password']=bcrypt($request['password']);
        }else{
            unset($request['password']);
        }

        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();
        return view('users.show', compact('user'));

    }

    public function eliminar(User $user, Request $request)
    {

        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('usuarios');
    }
}


