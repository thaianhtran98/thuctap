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
        Schema::create('kies', function (Blueprint $table) {
            $table->id();
            $table->integer('tuan');
            $table->integer('nam');
            $table->dateTime('tungay');
            $table->dateTime('denngay');
            $table->integer('chot');
            $table->integer('da_chot');
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
        Schema::dropIfExists('kies');
    }
};
