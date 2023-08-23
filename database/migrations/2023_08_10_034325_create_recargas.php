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
        Schema::create('recargas', function (Blueprint $table) {
            $table->id();
            $table->string('opcion');
            $table->string('cuadrilla');
            $table->double('monto');
            $table->string('numero_operacion')->unique();
            $table->date('fecha_recarga');
            $table->string('concepto');
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
        Schema::dropIfExists('recargas');
    }
};
