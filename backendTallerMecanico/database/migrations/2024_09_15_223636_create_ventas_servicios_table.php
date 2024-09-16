<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_servicios', function (Blueprint $table) {
            $table->id('venta_servicio_id');
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('tarea_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('venta_id')->references('venta_id')->on('ventas')->onDelete('cascade');
            $table->foreign('tarea_id')->references('tarea_id')->on('tareas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_servicios');
    }
}
