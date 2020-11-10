<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable =[
        'id','name','country_id'
    ];
    
    public function country (){
    $this->belongsTo('App\Models\country','country_id');
    }
}
