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
        Schema::create('otros', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('cuadrilla');
            $table->dateTime('fecha_insercion');
            $table->string("ruc"); 
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->date('fecha_documento');
            $table->string('autorizacion');
            $table->string('descripcion');
            $table->double('monto_total');
            $table->string('foto_otros');
            $table->foreignId('usuario_id')->references('id')->on('usuario_c_c_i_p_s');
            $table->unique(['ruc', 'numero_documento']);
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
        Schema::dropIfExists('otros');
    }
};
