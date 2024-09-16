<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('pago_id'); // Clave primaria
            $table->string('num_comprobante'); // Número de comprobante
            $table->integer('cantidad_pago'); // Cantidad pagada
            $table->string('descuento')->nullable(); // Descuento (opcional)
            $table->date('fecha'); // Fecha del pago
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
        Schema::dropIfExists('pagos');
    }
}
