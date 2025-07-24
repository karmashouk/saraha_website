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
 Schema::create('massages', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('from_user_id')->nullable(); // المرسل (ممكن يكون مجهول)
        $table->unsignedBigInteger('to_user_id'); // المستلم

        $table->text('content'); // نص الرسالة

        $table->timestamps();

        // العلاقات
        $table->foreign('from_user_id')->references('id')->on('users')->onDelete('set null');
        $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massages');
    }
};
