<?php
namespace App\Respositries;

use App\Interfaces\ProviderInterface;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use validator;
use App\Http\Controllers\ProviderController;
use App\Helpers\ApiResponse; 

class ProviderRepos implements ProviderInterface{

    public $apiResponse;
    public function __construct( ApiResponse $apiResponse)
    {
         
        $this->apiResponse = $apiResponse;

    }

  

    public function create_provider($data){  
        $provider= new Provider;
        $provider->email=$data['email'];
        $provider->password=app('hash')->make($data['password']);
        $provider->full_name=$data['full_name'];
        $provider->phone =$data['phone'];
        $provider->place_name=$data['place_name'];
        $provider->place_logo=$data['place_logo'];
        if (!empty($data['image'])) {
        $provider->image=$data['image'];
        }
        $provider->country_id = $data['country_id'];

        $provider->lang=$data['lang'];
        $provider->late=$data['late'];

        $provider->location=$data['location'];
        $provider->link_insta=$data['link_insta'];
        $provider->link_twitter=$data['link_twitter'];
        $provider->description=$data['description'];
        $provider->other_information=$data['other_information'];
        $provider->home_service=$data['home_service'];
        $provider->Token=$data['Token'];
        $provider->ApiToken= base64_encode(str_random(40));
        $provider->save();

        return $provider;
    }

    public function login_provider($data){
        $provider = Provider::where('email',$data['email'])->first();
        if($provider){
            $check=Hash::check($data['password'],$provider->password);
        }else{
            return $this->apiResponse->setError("Your email not found!")->setData();
        }
        if($check){
            $provider->Token = $data['Token'];
            $provider->ApiToken= base64_encode(str_random(40));
            $provider->save();

             return $this->apiResponse->setSuccess("Login Successfuly")->setData($provider);



        }else{
            return $this->apiResponse->setError("Your Password not correct!")->setData();
        }
        
    }
    public function logout_provider($data){
        
       $provider = Provider::where('ApiToken',$data['ApiToken'])->first();
       if($provider){
           $provider->ApiToken = "null";
           $provider->save();
           return $this->apiResponse->setSuccess("LogOut Successfuly")->setData();
       }else{
           return $this->apiResponse->setError("You are not Logging! ")->setData();

       }
        
    }
    



}