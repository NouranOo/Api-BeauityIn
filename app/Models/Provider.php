<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
     protected $fillable =[
        'id','email','password','full_name','phone','country','place_name','place_logo',
        'image','lang','late','location','link_insta','link_twitter','link_facebook','service_type','description',
        'other_information','home_service','ApiToken','Token'
         
    ];
    protected $hidden=array('created_at','updated_at');

    public function messages(){
        return $this->hasMany('App\Models\Message','provider_id');
    }

    public function favurites(){
        return $this->hasMany('App\Models\Favourite','provider_id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service','provider_services');
    }

    public function sub_services(){
        return $this->belongsToMany('App\Models\SubService','provider_subs' ,'provider_id','sub_id');
    }
}
