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
            $table->string('amountmosqueton');
            $table->string('pelacable');
            $table->string('amountpelacable');
            $table->string('crimpeadora');
            $table->string('amountcrimpeadora');
            $table->string('crimpeadorater');
            $table->string('amountcrimpeadorater');
            $table->string('limas');
            $table->string('amountlimas');
            $table->string('allen');
            $table->string('amountallen');
            $table->string('readline');
            $table->string('amountreadline');
            $table->string('impacto');
            $table->string('amountimpacto');
            $table->string('dielectricos');
            $table->string('amountdielectricos');
            $table->string('corte');
            $table->string('amountcorte');
            $table->string('fuerza');
            $table->string('amountfuerza');
            $table->string('recto');
            $table->string('amountrecto');
            $table->string('francesas');
            $table->string('amountfrancesas');
            $table->string('sierra');
            $table->string('amountsierra');
            $table->string('silicona');
            $table->string('amountsilicona');
            $table->string('polea');
            $table->string('amountpolea');
            $table->string('wincha');
            $table->string('amountwincha');
            $table->string('eslinga');
            $table->string('amounteslinga');
            $table->string('brocas');
            $table->string('amountbrocas');
            $table->string('sacabocado');
            $table->string('amountsacabocado');
            $table->string('extractor');
            $table->string('amountextractor');
            $table->string('juegollaves');
            $table->string('amountjuegollaves');
            $table->string('cuter');
            $table->string('amountcuter');
            $table->string('thor');
            $table->string('amountthor');
            $table->string('maletagrande');
            $table->string('amountmaletagrande');
            $table->string('maletamediana');
            $table->string('amountmaletamediana');
            $table->string('otros')->default(null);
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
