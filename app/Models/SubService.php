<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
class SubService extends Model
{
    //
    protected $fillable =[
        'id','name','price' , 
    ];
    protected $hidden=array('created_at','updated_at');

    // public function placeOfService(){
    //     return $this->belongsTo('App\Models\PlaceOfService','place_id');
    // } 
    public function orders(){
        return $this->belongsToMany('App\Models\orders','order_subs','sub_id','order_id');
    }
    public function providers(){
        return $this->belongsToMany('App\Models\Provider','provider_subs','provider_id','sub_id');
    }
}
