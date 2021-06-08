<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearValorEntrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_entrada', function (Blueprint $table) {
            $table->increments('id_valor')->auto();
            $table->unsignedInteger('id_entrada');
            $table->unsignedInteger('id_usuario');
            $table->decimal('valor');
            $table->timestamps();

            $table->foreign('id_entrada')->references('id_entrada')->on('entrada');
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
        Schema::dropIfExists('valor_entrada');

    }
}
