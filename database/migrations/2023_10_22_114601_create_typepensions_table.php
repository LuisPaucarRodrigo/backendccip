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
        Schema::create('typepensions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('val_csf', 10, 2);
            $table->decimal('val_pri_seg', 10, 2);
            $table->decimal('val_apor_obli', 10, 2);
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
        Schema::dropIfExists('typepensions');
    }
};
