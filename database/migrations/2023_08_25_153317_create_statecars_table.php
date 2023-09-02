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
        Schema::create('statecars', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string('placa');
            $table->string('bocina');
            $table->string('frenos');
            $table->string('lucesaltasbajas');
            $table->string('intermitentes');
            $table->string('direccionales');
            $table->string('retrovisores');
            $table->string('neumaticos');
            $table->string('parachoques');
            $table->string('temperatura');
            $table->string('aceite');
            $table->string('combustible');
            $table->string('aseovehiculo');
            $table->string('puertas');
            $table->string('parabrisas');
            $table->string('motor');
            $table->string('bateria');
            $table->string('foto_front');
            $table->string('foto_left');
            $table->string('foto_right');
            $table->string('foto_interno');
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
        Schema::dropIfExists('statecars');
    }
};
