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
        Schema::create('saluds', function (Blueprint $table) {
            $table->id();
            $table->string('grupo_sanguineo');
            $table->float('peso');
            $table->float('estatura');
            $table->string('talla_zapato');
            $table->string('talla_camisa');
            $table->string('talla_pantalon');
            $table->string('enfermedad')->nullable();
            $table->string('alergico_medicamento')->nullable();
            $table->string('operaciones')->nullable();
            $table->string('accidentes_graves')->nullable();
            $table->string('vacunas')->nullable();
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
        Schema::dropIfExists('saluds');
    }
};
