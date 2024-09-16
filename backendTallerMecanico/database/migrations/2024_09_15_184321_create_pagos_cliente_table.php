<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_cliente', function (Blueprint $table) {
            $table->id('pago_cliente_id'); // ID del pago cliente
            $table->unsignedBigInteger('venta_id'); // ID de la venta
            $table->unsignedBigInteger('cliente_id'); // ID del cliente
            $table->unsignedBigInteger('pago_id'); // ID del pago
            $table->string('observaciones')->nullable(); // Observaciones
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('venta_id')->references('venta_id')->on('ventas')->onDelete('cascade');
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes')->onDelete('cascade');
            $table->foreign('pago_id')->references('pago_id')->on('pagos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos_cliente');
    }
}
