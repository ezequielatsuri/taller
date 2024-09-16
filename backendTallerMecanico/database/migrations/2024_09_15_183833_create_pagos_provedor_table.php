<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosProvedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_provedores', function (Blueprint $table) {
            $table->id('pago_provedor_id'); // Clave primaria
            $table->unsignedBigInteger('provedor_id'); // Clave foránea referenciada a provedores
            $table->unsignedBigInteger('pago_id'); // Clave foránea referenciada a pagos
            $table->string('observaciones')->nullable(); // Observaciones opcionales
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Claves foráneas
            $table->foreign('provedor_id')->references('provedor_id')->on('provedores')->onDelete('cascade');
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
        Schema::dropIfExists('pagos_provedores');
    }
}
