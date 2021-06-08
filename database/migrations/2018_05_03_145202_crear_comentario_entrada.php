<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearComentarioEntrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_entrada', function (Blueprint $table) {
            $table->increments('id_comentario');
            $table->unsignedInteger('id_entrada');
            $table->unsignedInteger('id_usuario');
            $table->string('comentario');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_entrada')->references('id_entrada')->on('entrada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_entrada');

    }
}
