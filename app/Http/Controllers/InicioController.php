<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criptomoneda;
use App\HistorialCriptomoneda;

class InicioController extends Controller
{
    public function index()
    {
                $criptomonedas = Criptomoneda::all();


                return view('inicio.inicio', compact('criptomonedas'));
    }
}