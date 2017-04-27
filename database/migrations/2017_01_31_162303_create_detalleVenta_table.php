<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleVentas', function (Blueprint $table) {
            $table->integer('CodigoVenta');
        	$table->integer('CodigoProducto');
        	$table->integer('cantidad');
        	$table->integer('descuento');
        	$table->decimal('valorFac',10,2);
        	$table->decimal('ivaFac',10,2);
        	$table->foreign('CodigoVenta')
        	->references('CodigoVenta')->on('ventas')
        	->onDelete('cascade');
        	$table->foreign('CodigoProducto')
        	->references('id')->on('productos')
        	->onDelete('cascade');
        	$table->primary(['CodigoVenta', 'CodigoProducto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detalleVenta');
    }
}
