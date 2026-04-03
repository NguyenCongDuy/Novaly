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
        Schema::create('reading_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('story_id')->constrained();
            $table->foreignId('chapter_id')->constrained();

            $table->timestamp('last_read_at')->useCurrent();

            $table->unique(['user_id', 'story_id']);
            $table->index(['user_id', 'last_read_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_histories');
    }
};
