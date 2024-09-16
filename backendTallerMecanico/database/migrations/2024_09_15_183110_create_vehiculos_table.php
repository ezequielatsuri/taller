<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('vehiculo_id'); // Clave primaria
            $table->unsignedBigInteger('cliente_id'); // Clave foránea referenciada a clientes
            $table->string('modelo'); // Modelo del vehículo
            $table->string('marca'); // Marca del vehículo
            $table->integer('año'); // Año del vehículo
            $table->string('placa'); // Placa del vehículo
            $table->string('tipo'); // Tipo de vehículo
            $table->string('observaciones')->nullable(); // Observaciones opcionales
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Clave foránea
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
