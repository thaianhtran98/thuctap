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
            $table->date('ngaytiepnhan')->nullable();
            $table->date('ngaygiaoviec')->nullable();
            $table->date('ngayhoanthanh')->nullable();
            $table->date('ngayhostfix')->nullable();
            $table->date('ngayhoanthanhdukien')->nullable();
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
