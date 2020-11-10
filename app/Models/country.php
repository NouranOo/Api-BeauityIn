<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $fillable =[
        'id','name','slug','code'
    ];
    public function cities (){
        $this->hasmany('App\Models\city','country_id');
        }
}