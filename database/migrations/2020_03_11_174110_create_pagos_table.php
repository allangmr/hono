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
            $table->id();
            $table->decimal('monto_pagado', 8, 2);
            $table->string('metodo_pago', 20);
            $table->string('aseg_utilizada', 30);
            $table->unsignedBigInteger('id_procedimientos');
            $table->timestamps();
            $table->foreign('id_procedimientos')->references('id')->on('procedimientos');
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
