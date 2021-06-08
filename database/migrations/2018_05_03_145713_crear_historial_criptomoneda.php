<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearHistorialCriptomoneda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_criptomoneda', function (Blueprint $table) {
            $table->unsignedInteger('id_criptomoneda');
            $table->decimal('precio_dolar');
            $table->datetime('fecha');

            $table->foreign('id_criptomoneda')->references('id_criptomoneda')->on('criptomoneda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_criptomoneda');
    }
}
