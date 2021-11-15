<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class TourOperator extends Model
{
    protected $table = 'tour_operators';

    protected $fillable = [
        'name', 'mobile_number', 'email','comp_name','pan_number','gst','otp','pic','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get_comp_name_slug($company_name){
        return Str::slug($company_name, "-");
    }

    public static function get_id_by_company_name($comp_name){
        $tour_operator = TourOperator::where("comp_name_slug", $comp_name)->first();
        return ($tour_operator) ? $tour_operator->id : false;
    }

    public static function get_commission_by_company_name($comp_name){
        $tour_operator = TourOperator::where("comp_name_slug", $comp_name)->first();
        $commission_percent = $tour_operator ? (int)$tour_operator->commission_percent : 0;
        return $commission_percent/100;
    }
}
