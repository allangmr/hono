<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proc', 200);
            $table->dateTime('fec_inicio')->nullable();
            $table->dateTime('fec_fin')->nullable();
            $table->decimal('costo', 8, 2)->nullable();
            $table->decimal('pagado', 8, 2)->nullable();
            $table->boolean('estado');
            $table->unsignedBigInteger('id_atenciones');
            $table->timestamps();
            $table->foreign('id_atenciones')->references('id')->on('atenciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedimientos');
    }
}
