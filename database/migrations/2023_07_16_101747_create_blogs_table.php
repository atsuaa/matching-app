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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title')->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->unsignedTinyInteger('published')->default(0)->comment('公開フラグ 0:非公開 1:公開');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
