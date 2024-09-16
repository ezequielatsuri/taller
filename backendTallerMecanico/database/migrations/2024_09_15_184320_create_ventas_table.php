<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('venta_id'); // ID de la venta
            $table->unsignedBigInteger('cliente_id'); // ID del cliente
            $table->unsignedBigInteger('vehiculo_id')->nullable(); // ID del vehículo (opcional)
            $table->date('fecha'); // Fecha de la venta
            $table->integer('total'); // Total de la venta
            $table->string('observaciones')->nullable(); // Observaciones (opcional)
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
            $table->foreign('vehiculo_id')->references('vehiculo_id')->on('vehiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
