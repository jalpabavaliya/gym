<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal_old123 extends Model
{
    use HasFactory;
    protected $fillable = ['meal_categories_id','meal_name','image','video_url','description','ingredients','preparation_time','cooking_time','instructions','serving_sizes'];
}
