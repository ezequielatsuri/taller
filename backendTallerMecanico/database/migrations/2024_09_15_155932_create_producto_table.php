<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('producto_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('fabricante_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('descuento');
            $table->double('precio_compra');
            $table->double('precio_venta');
            $table->integer('producto_stock');
            $table->integer('producto_stock_minimo');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('categoria_id')->references('categoria_id')->on('categorias')->onDelete('cascade');
            $table->foreign('fabricante_id')->references('fabricante_id')->on('fabricantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
