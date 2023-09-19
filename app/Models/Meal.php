<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $table = "meals";
    protected $fillable = ['meal_name','meal_categories_id','prep_time','cook_time','tag','contain','image'];

}
