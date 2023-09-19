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
        Schema::create('meals_old123', function (Blueprint $table) {
            $table->id();
            $table->integer('meal_categories_id')->nullable();
            $table->string('meal_name')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->text('description')->nullable();
            $table->string('ingredients')->nullable();
            $table->string('preparation_time')->nullable();
            $table->string('cooking_time')->nullable();
            $table->text('instructions')->nullable();
            $table->string('serving_sizes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals_old123');
    }
};
