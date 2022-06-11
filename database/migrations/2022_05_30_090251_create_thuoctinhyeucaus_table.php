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
        Schema::create('thuoctinhyeucaus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_yc');
            $table->string('ten_thuoc_tinh');
            $table->string('kieu_thuoc_tinh');
            $table->string('noi_dung_thuoc_tinh');
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
        Schema::dropIfExists('thuoctinhyeucaus');
    }
};
