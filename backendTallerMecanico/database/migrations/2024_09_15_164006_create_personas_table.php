<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('persona_id'); // Clave primaria
            $table->string('nombre'); // Nombre de la persona
            $table->string('apellido_pat'); // Apellido paterno
            $table->string('apellido_mat'); // Apellido materno
            $table->string('correo'); // Correo electrónico
            $table->string('sexo'); // Sexo
            $table->integer('telefono'); // Teléfono
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
