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
            $table->unsignedBigInteger('id_centro_votacion');
            $table->foreign('id_centro_votacion')->references('id')->on('centro_votacions');
            $table->unsignedBigInteger('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->unsignedBigInteger('id_aldea');
            $table->foreign('id_aldea')->references('id')->on('aldeas');
            $table->unsignedBigInteger('id_partido');
            $table->foreign('id_partido')->references('id')->on('partidos');
            $table->unsignedBigInteger('id_area');
            $table->foreign('id_area')->references('id')->on('areas');
            $table->unsignedBigInteger('id_lugar_poblado');
            $table->foreign('id_lugar_poblado')->references('id')->on('lugar_poblados');
            $table->integer('votos_nulos');
            $table->integer('votos_en_blanco');
            $table->integer('total_votos');
            $table->integer('total_validos');
            $table->dateTime('fecha_acta_procesada');
            $table->string('observaciones');
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
