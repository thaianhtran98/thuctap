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
        Schema::create('luykes', function (Blueprint $table) {
            $table->integer('id_don_vi');
            $table->integer('luy_ke_hang_tuan');
            $table->integer('tuan');
            $table->integer('thang');
            $table->integer('nam');
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
        Schema::dropIfExists('luykes');
    }
};
