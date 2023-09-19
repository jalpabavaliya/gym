<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";
    protected $fillable = [
        'food_name',
        'serving_size',
        'serving_type',
        'calories',
        'protein',
        'carbs',
        'fat',
        'saturated_fat',
        'trans_fat',
        'polyunsaturated_fat',
        'monounsaturated_fat',
        'cholesterol',
        'sodium',
        'dietary_fiber',
        'sugar',
        'vitamin_a',
        'vitamin_c',
        'vitamin_d',
        'vitamin_e',
        'thiamin',
        'riboflavin',
        'niacin',
        'vitamin_b_6',
        'vitamin_b_12',
        'pantothenic_acid',
        'calcium',
        'iron',
        'potassium',
        'phosphorus',
        'magnesium',
        'zinc',
        'selenium',
        'copper',
        'manganese',
        'alcohol',
        'caffeine',
    ];

}
