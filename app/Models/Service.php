<?php

namespace App\Models;
 

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
     protected $fillable =[
        'id','name','type'
    ];
    protected $hidden=array('created_at','updated_at');

    public function providers(){
        return $this->belongsToMany('App\Models\Provider','provider_services');
    }
}
