<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatDonorsTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_donors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('tanggal_donor');
            $table->float('berat_badan');
            $table->string('keterangan')->nullable();
            $table->integer('donor_ke');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_donors');
    }
}
