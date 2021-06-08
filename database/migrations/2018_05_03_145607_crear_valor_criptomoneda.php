<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearValorCriptomoneda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_criptomoneda', function (Blueprint $table) {
            $table->unsignedInteger('id_criptomoneda');
            $table->unsignedInteger('id_usuario');
            $table->decimal('valor');
            $table->timestamps();

            $table->foreign('id_criptomoneda')->references('id_criptomoneda')->on('criptomoneda');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valor_criptomoneda');

    }
}
