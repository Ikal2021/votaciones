<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            //llave foranea de la tabla centros
            $table->unsignedBigInteger('id_centro_votacion');
            $table->foreign('id_centro_votacion')->references('id')->on('centro_votacions');
            $table->integer('votos_nulos');
            $table->integer('votos_en_blanco');
            $table->integer('votos_totales');//votos procesados
            $table->integer('total_votos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
