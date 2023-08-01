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
        Schema::table('users', function (Blueprint $table) {
            $table->string('roomID')->nullable(); // Thêm cột mới kiểu dữ liệu string và có thể để giá trị null
            // Hoặc nếu muốn cột không chấp nhận giá trị null:
            // $table->string('new_column');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['roomID']);
        });
    }
};