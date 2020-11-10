<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =[
        'id','number_people','day','time','home_service',
        'note','user_id','status', 
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
   
    public function sub_Services(){
        return $this->belongsToMany('App\Models\SubService','order_subs','sub_id','order_id');
    }
}
