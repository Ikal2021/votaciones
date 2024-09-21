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
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();

            //llave foranea de la tabla personamovimientos
            $table->unsignedBigInteger('id_persona_por_movimiento');
            $table->foreign('id_persona_por_movimiento')->references('id')->on('personamovimientos');
            //llave foranea tabla actas
            $table->unsignedBigInteger('id_acta');
            $table->foreign('id_acta')->references('id')->on('actas');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};
