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
        Schema::create('thread_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->index('thread_id');
            $table->index('user_id');
            $table->comment('スレッドに参加するユーザー');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_members');
    }
};
