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
        Schema::create('equipmentcars', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string('extintor');
            $table->string('botiquin');
            $table->string('conos');
            $table->string('gata');
            $table->string('neumatico');
            $table->string('ca_remolque');
            $table->string('ca_bateria');
            $table->string('reflejante');
            $table->string('kit');
            $table->string('alarma');
            $table->string('gps');
            $table->string('tacos');
            $table->string('interna');
            $table->string('antivuelco');
            $table->string('portaescalera');
            $table->string('placalateral');
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
        Schema::dropIfExists('equipmentcars');
    }
};
