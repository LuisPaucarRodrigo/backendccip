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
        Schema::create('kittolls', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string('mosqueton');
            $table->string('pelacable');
            $table->string('crimpeadora');
            $table->string('limas');
            $table->string('allen');
            $table->string('readline');
            $table->string('impacto');
            $table->string('dielectricos');
            $table->string('corte');
            $table->string('fuerza');
            $table->string('recto');
            $table->string('francesas');
            $table->string('sierra');
            $table->string('silicona');
            $table->string('polea');
            $table->string('wincha');
            $table->string('eslinga');
            $table->string('brocas');
            $table->string('sacabocado');
            $table->string('extractor');
            $table->string('maletagrande');
            $table->string('maletamediana');
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
        Schema::dropIfExists('kittolls');
    }
};
