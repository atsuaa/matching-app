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
        Schema::create('thread_viewings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id');
            $table->foreignId('user_id');
            $table->unsignedTinyInteger('is_viewing')->comment('閲覧する');
            $table->timestamps();

            $table->index('thread_id');
            $table->index('user_id');
            $table->comment('スレッドを表示するユーザー');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_viewings');
    }
};
