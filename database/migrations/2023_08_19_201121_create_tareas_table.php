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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('zona');
            $table->string('site');
            $table->string('titulo');
            $table->text('operaciones');
            $table->string('descripcion',1000);
            $table->string('observaciones', 1000)->nullable()->default(null);
            $table->string('crqincidencias', 20)->nullable()->default(null);
            $table->date('fechaCreacion');
            $table->date('fechaVencimiento');
            $table->string('state')->default('Iniciar');
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
        Schema::dropIfExists('tareas');
    }
};
