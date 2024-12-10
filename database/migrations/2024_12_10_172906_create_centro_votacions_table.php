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
        Schema::create('centro_votacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->unsignedBigInteger('id_aldea');
            $table->foreign('id_aldea')->references('id')->on('aldeas');
            $table->unsignedBigInteger('id_area');
            $table->foreign('id_area')->references('id')->on('areas');
            $table->unsignedBigInteger('id_lugar_poblado');
            $table->foreign('id_lugar_poblado')->references('id')->on('lugar_poblados');
            $table->string('codigo_centro');
            $table->string('nombre_centro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_votacions');
    }
};
