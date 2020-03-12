<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->char('nombre', 100);
            $table->date('fec_nacimiento')->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('direccion',70)->nullable();
            $table->string('email',60)->nullable()->unique();
            $table->string('cedula',30)->unique();
            $table->unsignedBigInteger('id_estado');
            $table->timestamps();
            $table->foreign('id_estado')->references('id')->on('estado_paciente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
