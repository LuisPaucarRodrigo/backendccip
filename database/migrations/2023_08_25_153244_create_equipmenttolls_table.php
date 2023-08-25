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
        Schema::create('equipmenttolls', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string('hidrolavadora');
            $table->string('sopladora');
            $table->string('megometro');
            $table->string('telurometro');
            $table->string('aperimetrica');
            $table->string('manometro');
            $table->string('pirometro');
            $table->string('laptop');
            $table->string('taladro');
            $table->string('brujula');
            $table->string('inclinometro');
            $table->string('linterna');
            $table->string('powermeter');
            $table->string('pistola');
            $table->string('pertiga');
            $table->string('cuter');
            $table->string('escalera');
            $table->string('extension');
            $table->string('pistolaestano');
            $table->string('escaleratijera');
            $table->string('carrito');
            $table->foreignId('usuario_id')->references('id')->on('usuario_c_c_i_p_s');
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
        Schema::dropIfExists('equipmenttolls');
    }
};
