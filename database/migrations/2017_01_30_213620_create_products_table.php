<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name',100);
            $table->decimal('precpu',14,2);
            $table->decimal('costo',14,2);
            $table->integer('categoria');
            $table->string('ReferenciaOEM',30);
            $table->string('Descripcion',1000);
            $table->string('foto',100);
            $table->date('fechaRetiro',100)->nullable();
            $table->smallInteger('ivap');
            $table->char('iva',2);
            $table->char('activo',2);
            $table->timestamps();
            $table->foreign('categoria')
            ->references('id')->on('categorias')
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
        Schema::drop('productos');
    }
}
