<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearComentarioCriptomoneda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_criptomoneda', function (Blueprint $table) {
            $table->increments('id_comentario');
            $table->unsignedInteger('id_criptomoneda');
            $table->unsignedInteger('id_usuario');
            $table->string('comentario');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('comentario_criptomoneda');

    }
}
