<?php

namespace App\Http\Controllers;

use App\Interfaces\ProviderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use validator;
use App\Models\Provider;
use App\Helpers\ApiResponse;

class ProviderController extends Controller
{

    public $provider;
    public $user;
    public $apiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProviderInterface $provider,UserInterface $user,ApiResponse $apiResponse)
    {
        $this->user = $user;
        $this->provider = $provider;
        $this->apiResponse = $apiResponse;

    }
    

    public function register(Request $request){
        
        $rules = [
            'email'=>'required|unique:providers',
            'phone' => 'required|numeric|unique:providers',
            'password' =>'required|between:6,255|same:confirm_password',
            'confirm_password' => 'required',
            'full_name'=>'required|max:15|min:3',
            'place_name' =>'required',
            // 'place_logo' => 'required',
            // 'image' => 'required',
            'lang' => 'required',
            'late' => 'required',
            'location' => 'required',
            'link_insta' => 'required',
            'link_twitter' => 'required',
            // 'description' => 'required',
             'country_id' =>'required|numeric',

            'home_service' => 'required',
            'Token' => 'required',
            'apiKey' => 'required',
            

        ];
      
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();  //new way to send responce      

        }
           $data=$request->except('image','place_logo');

        if ($request->hasFile('image')) {
          
            $file = $request->file("image");
            $filename = str_random(6) . '_' . time() . '_' . $file->getClientOriginalName();
            $path = 'ProjectFiles/Provider_images';
            $file->move($path, $filename);
            $data['image'] = $path . '/' . $filename;
        }
        if ($request->hasFile('place_logo')) {
          
            $file = $request->file("place_logo");
            $filename = str_random(6) . '_' . time() . '_' . $file->getClientOriginalName();
            $path = 'ProjectFiles/Provider_images';
            $file->move($path, $filename);
            $data['place_logo'] = $path . '/' . $filename;
        }
        
    
        $result = $this->provider->create_provider($data);
        if($result){
            return $this->apiResponse->setSuccess(" created Successfuly")->setData($result)->send();       
        }
        else{
            return $this->apiResponse->setError(" Ops not created successfully")->setData()->send();        //keep setData empty because in android must have same response structure if return data success of fail

        }
    }

    public function login(Request $request){
        $rules=[
            'email' => 'required',
            'password'=>'required',
            'Token'=>'required',
            'apiKey'=>'required',

        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
//check apiKey
        $api_key = env('APP_KEY');
        if($api_key != $request->apiKey){
            return $this->apiResponse->setError("Unauthorized!")->send();
        }
        $data=$request->all();
        $result = $this->provider->login_provider($data);
        
        return $result->send();   
}

    public function logout(Request $request){
        $rules=[
            'ApiToken' => 'required',
            'apiKey' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }

        $api_key = env('APP_KEY');
        if($api_key != $request->apiKey){
            return $this->apiResponse->setError("Unauthorized!")->send();
        }
        $data=$request->all();
        $result = $this->provider->logout_provider($data);

        return $result->send();
    }
    public function showServices(Request $request){
        $rules = [
            'ApiToken' => 'required',
            'apiKey' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $api_key = env('APP_KEY');
        if($api_key != $request->apiKey){
            return $this->apiResponse->setError("Unauthorized!")->send();
        }
        $result = $this->user->showService();

        if($result){
            return $this->apiResponse->setSuccess("Show Success")->setData($result)->send();
        }else{
            return $this->apiResponse->setError("Show Failed")->setData()->send();
        }
    }
    public function cities()
    {
        $result = $this->user->cities();
        return $result;

    }
    public function countries()
    {
        $result = $this->user->countries();
        return $result;

}
 
}