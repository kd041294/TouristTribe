<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'tour_operator_id', 'name', 'type','total_member_size','min_family_member','name_of_city','location_images'
    ];
}
