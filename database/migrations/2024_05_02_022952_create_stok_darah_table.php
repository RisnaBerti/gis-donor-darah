<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokDarahTable extends Migration
{
    public function up()
    {
        Schema::create('stok_darah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('jenis_id')->references('id')->on('jenis_darah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_darah');
    }
}
