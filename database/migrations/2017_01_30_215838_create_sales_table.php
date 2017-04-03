<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
        	$table->increments('CodigoVenta');
        	$table->integer('idCliente');
        	$table->decimal('valorFacturado',12,2);
        	$table->datetime('fechatx',100);
        	$table->decimal('ivac',12,2);
        	$table->char('confirmado',2);
        	$table->foreign('idCliente')
        	->references('documento')->on('users')
        	->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ventas');
    }
}
