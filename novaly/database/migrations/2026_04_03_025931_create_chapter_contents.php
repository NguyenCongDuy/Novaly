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
        Schema::create('chapter_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('chapter_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->longText('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter_contents');
    }
};
