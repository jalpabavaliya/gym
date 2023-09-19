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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->string('serving_size');
            $table->string('serving_type');
            $table->string('calories');
            $table->string('protein');
            $table->string('carbs');
            $table->string('fat');
            $table->string('saturated_fat')->nullable();
            $table->string('trans_fat')->nullable();
            $table->string('polyunsaturated_fat')->nullable();
            $table->string('monounsaturated_fat')->nullable();
            $table->string('cholesterol')->nullable();
            $table->string('sodium')->nullable();
            $table->string('dietary_fiber')->nullable();
            $table->string('sugar')->nullable();
            $table->string('vitamin_a')->nullable();
            $table->string('vitamin_c')->nullable();
            $table->string('vitamin_d')->nullable();
            $table->string('vitamin_e')->nullable();
            $table->string('thiamin')->nullable();
            $table->string('riboflavin')->nullable();
            $table->string('niacin')->nullable();
            $table->string('vitamin_b_6')->nullable();
            $table->string('vitamin_b_12')->nullable();
            $table->string('pantothenic_acid')->nullable();
            $table->string('calcium')->nullable();
            $table->string('iron')->nullable();
            $table->string('potassium')->nullable();
            $table->string('phosphorus')->nullable();
            $table->string('magnesium')->nullable();
            $table->string('zinc')->nullable();
            $table->string('selenium')->nullable();
            $table->string('copper')->nullable();
            $table->string('manganese')->nullable();
            $table->string('alcohol')->nullable();
            $table->string('caffeine')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
