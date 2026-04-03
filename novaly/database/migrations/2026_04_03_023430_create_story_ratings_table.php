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
        Schema::create('story_ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('story_id')->constrained();
            $table->tinyInteger('rating');

            $table->timestamps();

            $table->primary(['user_id', 'story_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_ratings');
    }
};
