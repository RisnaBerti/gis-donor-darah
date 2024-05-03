<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisDarahTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_darah', function (Blueprint $table) {
            $table->id();
            $table->enum('goldar', ['A', 'B', 'AB', 'O']);
            $table->enum('rhesus', ['+', '-']);
            $table->string('kategori')->nullable();
            $table->string('masa_kadaluarsa')->nullable();
            $table->string('suhu_simpan')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_darah');
    }
}
