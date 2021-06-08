<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCriptomoneda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criptomoneda', function (Blueprint $table) {
            $table->increments('id_criptomoneda')->unsigned();
            $table->string('nombre');
            $table->integer('ranking')->nullable();
            $table->double('volumen_24h')->nullable();
            $table->double('capital_mercado_dolar');
            $table->double('total_circulacion');
            $table->decimal('porcentaje_1h')->nullable();
            $table->decimal('porcentaje_24h')->nullable();
            $table->decimal('porcentaje_7d')->nullable();
            $table->decimal('precio_btc')->nullable();
            $table->dateTime('fecha');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criptomoneda');

    }
}
