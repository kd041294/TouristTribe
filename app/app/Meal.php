<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
    	'tour_operator_id','location_id','location_name','breakfast_details','lunch_details',
    	'evening_tea_details','dinner_details','per_head_cost'
    ];
}
