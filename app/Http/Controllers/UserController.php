<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;
use validator;
use App\Models\Provider;

class UserController extends Controller
{

    public $user;
    public $apiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user, ApiResponse $apiResponse)
    {
        $this->user = $user;
        $this->apiResponse = $apiResponse;

    }

    public function register(Request $request)
    {

        $rules = [
            'email' => 'required|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|between:6,255|same:confirm_password',
            'confirm_password' => 'required',
            'name' => 'required|max:15|min:3',
            'country_id' => 'required|numeric',
            'confirm_phone' => 'required',
            'user_type' => 'required',
            'Token' => 'required',
            'apiKey' => 'required',

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send(); //new way to send responce

        }
        //check if country id is exist
        if (!country::find($request->country_id)) {
            return $this->apiResponse->setError(" Ops Country id not exist 1 for egypt(+20) 2 for sudia arabia(+966)")->setData()->send(); //keep setData empty because in android must have same response structure if return data success of fail

        }
        $data = $request->except('image');

        if ($request->hasFile('image')) {

            $file = $request->file("image");
            $filename = str_random(6) . '_' . time() . '_' . $file->getClientOriginalName();
            $path = 'ProjectFiles/user_image';
            $file->move($path, $filename);
            $data['image'] = $path . '/' . $filename;
        }

        $result = $this->user->create_user($data);
        return $result->send();
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'Token' => 'required',
            'apiKey' => 'required',

        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $api_key = env('APP_KEY');
        if ($api_key != $request->apiKey) {
            return $this->apiResponse->setError("Unauthorized!")->send();
        }
        $data = $request->all();
        $result = $this->user->login_user($data);

        return $result->send();
    }

    public function logout(Request $request)
    {
        $rules = [
            'ApiToken' => 'required',
            'apiKey' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }

        $api_key = env('APP_KEY');
        if ($api_key != $request->apiKey) {
            return $this->apiResponse->setError("Unauthorized!")->send();
        }
        $data = $request->all();
        $result = $this->user->logout_user($data);

        return $result->send();
    }
    public function showServices(Request $request)
    {

        $result = $this->user->showService();

        if ($result) {
            return $this->apiResponse->setSuccess("Show Success")->setData($result)->send();
        } else {
            return $this->apiResponse->setError("Show Failed")->setData()->send();
        }
    }

    public function showProviders(Request $request)
    {
        $rules = [
            'service_id' => 'required',
            'city_id' => 'required'
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $data=$request->all();
        $result = $this->user->showProviders($data);

    }
    public function RequestOrder(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric',
            'sub_id' => 'required|numeric',
            'number_people' => 'required|numeric',
            'day' => 'required',
            'time' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $data = $request->all();
        //get current user
        $user = GeneralHelper::getcurrentUser();
        $data['user_id'] = $user->id;

        $result = $this->user->requestOrder($data);
        return $result->send();
    }
    
    public function AddToFavorite(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $data = $request->all();
        //get current user
        $user = GeneralHelper::getcurrentUser();
        $data['user_id'] = $user->id;

        $result = $this->user->AddToFavorite($data);
        return $result->send();

    }
    public function DeleteFromFavorite(Request $request)
    {
        $rules = [
            'provider_id' => 'required|numeric',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }
        $data = $request->all();
        //get current user
        $user = GeneralHelper::getcurrentUser();
        $data['user_id'] = $user->id;

        $result = $this->user->DeleteFromFavorite($data);
        return $result->send();

    }
    public function getPlaceServices(Request $request)
    {
        $rules = [
            'place_id' => 'required|numeric',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }

        $result = $this->user->getplaceserviceById($request->place_id);
        return $result;

    }
    public function updateprofile(Request $request)
    {
        $user = GeneralHelper::getcurrentUser();
          // return response()->json($user);
        $rules = [
            'email'  =>  'required|unique:users,email,'.$user->id, // <--- THIS LINE to ignore user form check
            'phone' => 'numeric|unique:users,phone,' . $user->id, // will ignore this user id for unique check
            'password' => 'between:6,10',
            'name' => 'max:15|min:3,name,' . $user->id,
            'country_id' => 'numeric',
            
 
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->apiResponse->setError($validation->errors()->first())->send();
        }

        $data = $request->except('image');

        if ($request->hasFile('image')) {

                // if (\File::exists($currentUser->image)) {
                //     unlink($image_path);
                // }
            $file = $request->file("image");
            $filename = str_random(6) . '_' . time() . '_' . $file->getClientOriginalName();
            $path = 'ProjectFiles/user_image';
            $file->move($path, $filename);
            $data['image'] = $path . '/' . $filename;
        }
        $result = $this->user->UpdateProfile($data);
        return $result->send();
    }
    public function cities()
    {
        $result = $this->user->cities();
        return $result->send();

    }
    public function countries()
    {
        $result = $this->user->countries();
        return $result->send();

    }
    public function MyOrders()
    {
        $result = $this->user->MyOrders();
        return $result->send();
    }
    public function MyFavorits()
    {
        $result = $this->user->MyFavorits();
        return $result->send();
    }
}
