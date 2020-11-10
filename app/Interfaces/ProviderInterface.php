<?php

namespace App\Interfaces; 
use App\Http\Controllers\ProviderController;
 
interface ProviderInterface{

    public function create_provider($data);
    
    public function login_provider($data); 

    public function logout_provider($data);
 
     
}