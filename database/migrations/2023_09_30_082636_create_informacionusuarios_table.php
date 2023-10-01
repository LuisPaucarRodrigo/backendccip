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
        Schema::create('informacionusuarios', function (Blueprint $table) {
            $table->id();
            $table->string('regimen_pensionario');
            $table->date('fecha_ingreso');
            $table->decimal('sueldo_base', 10, 2);
            $table->string('institucion_carrera');
            $table->string('donde_estudio');
            $table->string('carrera_estudio');
            $table->string('condicion_magister');
            $table->boolean('tiene_carga_familiar')->default(false);
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
        Schema::dropIfExists('informacionusuarios');
    }
};
