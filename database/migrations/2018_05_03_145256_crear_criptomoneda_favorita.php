<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCriptomonedaFavorita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criptomoneda_favorita', function (Blueprint $table) {
            $table->unsignedInteger('id_criptomoneda');
            $table->unsignedInteger('id_usuario');
            $table->timestamps();

            $table->foreign('id_criptomoneda')->references('id_criptomoneda')->on('criptomoneda');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->primary(['id_usuario','id_criptomoneda']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criptomoneda_favorita');

    }
}
