<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->references('id')->on('usuario_c_c_i_p_s');
            $table->string("cuadrilla");
            $table->dateTime('fecha_insercion');
            $table->string("ruc"); 
            $table->string("tipo_documento");        
            $table->string("nro_documento");
            $table->dateTime("fecha_documento");
            $table->string("concepto");
            $table->double("gasto");
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
        Schema::dropIfExists('operaciones');
    }
};
