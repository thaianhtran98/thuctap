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
        Schema::create('donvis', function (Blueprint $table) {
            $table->id();
            $table->string('ten_don_vi')->unique();
            $table->integer('luy_ke_dau_ky')->nullable();
            $table->integer('uu_tien');
            $table->integer('hoat_dong');
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
        Schema::dropIfExists('donvis');
    }
};
