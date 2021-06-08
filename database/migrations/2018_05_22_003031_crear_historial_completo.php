<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearHistorialCompleto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_completo', function (Blueprint $table) {
            $table->unsignedInteger('id_criptomoneda');
            $table->decimal('precio_dolar');
            $table->date('fecha');

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
        Schema::dropIfExists('historial_completo');
    }
}
