<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable =[
        'id','user_id','provider_id','subject'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function provider(){
        return $this->belongsTo('App\Models\Provider','provider_id');
    }
}
