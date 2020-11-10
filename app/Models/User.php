<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends model
{
    // use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id','name', 'email', 'password','phone','country_id','user_type','image',
         'ApiToken','Token','late','lang','fb_id','go_id','tw_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];

    public function orders(){
        return $this->hasMany('App\Models\Order','user_id');
    }

    public function favourites(){
        return $this->hasMany('App\Models\Favourite','user_id');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message','user_id');
    }

}
