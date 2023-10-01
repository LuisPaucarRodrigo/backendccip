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
        Schema::create('alquilerhabitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('control_gastos');
            $table->string('zona');
            $table->string('nombre');
            $table->date('inicio_alquiler')->nullable();
            $table->date('fin_alquiler')->nullable();
            $table->decimal('costo_alquiler', 10, 2)->nullable();
            $table->decimal('garantia', 10, 2)->nullable();
            $table->string('contrato')->nullable();
            $table->date('fecha_pago')->nullable();
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
        Schema::dropIfExists('alquilerhabitaciones');
    }
};
