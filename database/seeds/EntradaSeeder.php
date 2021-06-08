<?php

use Illuminate\Database\Seeder;
use App\Entrada;

class EntradaSeeder extends Seeder
{
    public function run()
    {
        $entrada = new Entrada();
        $entrada->titulo = '¿Que son en realidad las Criptomonedas?';
        $entrada->texto = 'Hola a todos, queria abrir un debate sobre que son fisicamente las Criptomonedas, o si solo es humo';
        //$entrada->etiquetas='texto, prueba, funciona';
        $entrada->id_usuario= '1';
        $entrada->save();


        $entrada = new Entrada();
        $entrada->titulo = 'Otras criptomonedas no conocidas';
        $entrada->texto = 'Hola a todos, hoy vengo a explicar algo que he visto por internet. Me gustaria listar otro tipo de criptomonedas y compartir cuales son las más potenciales:.....';
        //$entrada->etiquetas='texto, prueba, funciona';
        $entrada->id_usuario= '2';
        $entrada->save();
    }
}
