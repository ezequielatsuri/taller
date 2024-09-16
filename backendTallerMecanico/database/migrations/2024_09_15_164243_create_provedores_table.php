<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provedores', function (Blueprint $table) {
            $table->id('provedor_id'); // Clave primaria
            $table->unsignedBigInteger('persona_id'); // Clave foránea referenciada a personas
            $table->string('contacto'); // Información de contacto
            $table->string('razon_social'); // Razón social del proveedor
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Clave foránea
            $table->foreign('persona_id')->references('persona_id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provedores');
    }
}

