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
        Schema::create('loaingays', function (Blueprint $table) {
            $table->integer('id_yc');
            $table->dateTime('ngaytiepnhan')->nullable();
            $table->dateTime('ngaygiaoviec')->nullable();
            $table->dateTime('ngayhoanthanh')->nullable();
            $table->dateTime('ngayhostfix')->nullable();
            $table->dateTime('ngayhoanthanhdukien')->nullable();
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
        Schema::dropIfExists('loaingays');
    }
};
