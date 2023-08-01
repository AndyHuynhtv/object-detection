<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkingTime', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('number');
            $table->string('pictureURL');
            $table->unsignedBigInteger('IDofRoom');
            // Khóa ngoại "roomID" liên kết đến cột "id" trong bảng "room"
            $table->foreign('IDofRoom')->references('id')->on('room');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkingTime');
    }
};
