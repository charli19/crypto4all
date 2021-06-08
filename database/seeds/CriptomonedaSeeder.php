<?php

use Illuminate\Database\Seeder;

use App\Criptomoneda;

class CriptomonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tabla = new Criptomoneda();
        $tabla->nombre = 'Bitcoin';
        $tabla->capital_mercado_dolar = '9000';
        $tabla->total_circulacion = '5455121';
        $tabla->fecha = '2018-05-15';
        $tabla->save();

        $tabla = new Criptomoneda();
        $tabla->nombre = 'Ethereum';
        $tabla->capital_mercado_dolar = '9000';
        $tabla->total_circulacion = '5455121';
        $tabla->fecha = '2018-05-15';
        $tabla->save();

        $tabla = new Criptomoneda();
        $tabla->nombre = 'Litecoin';
        $tabla->capital_mercado_dolar = '9000';
        $tabla->total_circulacion = '5455121';
        $tabla->fecha = '2018-05-15';
        $tabla->save();

        $tabla = new Criptomoneda();
        $tabla->nombre = 'Bitcoin Cash';
        $tabla->capital_mercado_dolar = '9000';
        $tabla->total_circulacion = '5455121';
        $tabla->fecha = '2018-05-15';
        $tabla->save();


    }
}
