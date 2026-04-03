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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->cascadeOnDelete();
            $table->integer('chapter_number');
            $table->string('title')->nullable();

            $table->enum('access_type', ['free', 'coin', 'premium'])->default('free');

            $table->integer('coin_price')->nullable();
            $table->decimal('money_price', 10, 2)->nullable();

            $table->unsignedBigInteger('view_count')->default(0);

            $table->timestamps();
            $table->unique(['story_id', 'chapter_number']);
            $table->index(['story_id', 'chapter_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
