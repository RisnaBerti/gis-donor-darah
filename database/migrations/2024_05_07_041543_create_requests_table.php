<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencari_id');
            $table->enum('goldar', ['A', 'B', 'O', 'AB']);
            $table->enum('rhesus', ['Positif', 'Negatif']);
            $table->integer('jumlah');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->enum('sumber', ['Stok', 'Pendonor']);
            $table->unsignedBigInteger('pendonor_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pencari_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pendonor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
