<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->string('hospital', 60)->nullable();
            $table->dateTime('fec_inicio')->nullable();
            $table->dateTime('fec_fin')->nullable();
            $table->boolean('estado')->default(3);
            $table->unsignedBigInteger('id_pacientes');
            $table->unsignedBigInteger('id_doctores');
            $table->timestamps();
            $table->foreign('id_pacientes')->references('id')->on('pacientes');
            $table->foreign('id_doctores')->references('id')->on('doctores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atenciones');
    }
}
