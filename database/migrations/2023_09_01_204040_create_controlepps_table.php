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
        Schema::create('controlepps', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string('carroanticaidas');
            $table->string('amountcarroanticaidas');
            $table->string('lineavida');
            $table->string('amountlineavida');
            $table->string('lineaposicionamiento');
            $table->string('amountlineaposicionamiento');
            $table->string('arnes');
            $table->string('amountarnes');
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
        Schema::dropIfExists('controlepps');
    }
};
