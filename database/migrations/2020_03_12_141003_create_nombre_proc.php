<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNombreProc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nombre_proc', function (Blueprint $table) {
            $table->id();
            $table->char('nombre', 50);
            $table->decimal('costo', 8, 2)->nullable();
            $table->char('detalle_costo', 30)->nullable();
            $table->char('codigo', 30)->nullable();
            $table->char('rol_proc', 30)->nullable();
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nombre_proc');
    }
}
