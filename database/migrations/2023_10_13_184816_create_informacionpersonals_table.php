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
        Schema::create('informacionpersonals', function (Blueprint $table) {
            $table->id();
            $table->string('sexo');
            $table->string('estado_civil');
            $table->date('fecha_nacimiento');
            $table->string('telefono_movil1');
            $table->string('telefono_movil2')->nullable();
            $table->string('correo_personal');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('informacionpersonals');
    }
};
