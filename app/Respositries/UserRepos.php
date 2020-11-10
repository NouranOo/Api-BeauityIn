<?php
namespace App\Respositries;
use App\Helpers\ApiResponse;
use App\Interfaces\UserInterface;
use App\Models\city;
use App\Models\country;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\PlaceOfService;
use App\Models\Service;
use App\Models\User;
use App\Models\Provider;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GeneralHelper;
use App\Models\SubService;
class UserRepos implements UserInterface
{

    public $apiResponse;
    public $generalhelper;
    public function __construct(GeneralHelper $generalhelper,ApiResponse $apiResponse)
    {
        $this->generalhelper = $generalhelper;

        $this->apiResponse = $apiResponse;

    }

    public function create_user($data)
    {
        $user = new User;
        $user->email = $data['email'];
        $user->password = app('hash')->make($data['password']);
        $user->name = $data['name'];
        if (!empty($data['image'])) {$user->image = $data['image'];}
        $user->country_id = $data['country_id'];
        $user->phone = $data['phone'];
        $user->user_type = $data['user_type'];
        $user->Token = $data['Token'];
        if (!empty($data['late'])) {
            $user->late = $data['late']; } else {$user->late = 0; }
        if (!empty($data['lang'])) { $user->lang = $data['lang']; } else { $user->lang = 0; }
        if (!empty($data['fb_id'])) {$user->fb_id = $data['fb_id'];} else {$user->fb_id = 0;}
        if (!empty($data['go_id'])) {$user->go_id = $data['go_id'];} else {$user->go_id = 0;}
        if (!empty($data['tw_id'])) { $user->tw_id = $data['tw_id'];} else {$user->tw_id = 0;}

        $user->ApiToken = base64_encode(str_random(40));

        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError("Ops cant't create User ")->setData();
        }
        return $this->apiResponse->setSuccess("User created succesfully")->setData($user);
    }

    public function login_user($data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $check = Hash::check($data['password'], $user->password);
        } else {
            return $this->apiResponse->setError("Your email not found!")->setData();
        }
        if ($check) {
            $user->Token = $data['Token'];
            $user->ApiToken = base64_encode(str_random(40));

            try {
                $user->save();
            } catch (\Illuminate\Database\QueryException $ex) {
                return $this->apiResponse->setError($ex->getMessage())->setData();
            }
            return $this->apiResponse->setSuccess("Login Successfuly")->setData($user);

        } else {
            return $this->apiResponse->setError("Your Password not correct!")->setData();
        }

    }
    public function logout_user($data)
    {

        $user = User::where('ApiToken', $data['ApiToken'])->first();
        if ($user) {
            $user->ApiToken = "null";
            $user->save();
            return $this->apiResponse->setSuccess("LogOut Successfuly")->setData();
        } else {
            return $this->apiResponse->setError("You are not Logging! ")->setData();

        }

    }

    public function showService()
    {

        $services = Service::with(['providers' => function ($query) {
            $query->with('sub_services');
        }])->get();

        return $services;

    }
    public function requestOrder($data)
    {
        try {
            $data['status']='pending';
 
            $order = Order::create($data);
            // return response()->json($order);
             $order->sub_Services()->attach($data['sub_id']);
            
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex->getMessage())->setData();
        }
        return $this->apiResponse->setSuccess("Order created Successfuly")->setData($order);

    }
    public function getServiceplacesByCityId($data)
    {
        try {
            $places = PlaceOfService::where('service_id', $data['service_id'])->where('city', $data['city_id'])->get();

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex->getMessage())->setData();

        }
        return $this->apiResponse->setSuccess(" show Successfuly")->setData($places);

    }
    public function AddToFavorite($data)
    {
        try {
            $favorite = Favourite::create($data);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex->getMessage())->setData();

        }
        return $this->apiResponse->setSuccess(" Added to favorite Successfuly")->setData($favorite);
    }
    public function DeleteFromFavorite ($data){
        try{
            $favorite=Favourite::where('provider_id',$data['provider_id'])->delete();

        }catch(\Illuminate\Database\QueryException $ex){
            return $this->apiResponse->setError($ex->getMessage())->setData();
        }
        return $this->apiResponse->setSuccess(" Deleted from favorite Successfuly")->setData($favorite);
    }
    public function getplaceserviceById($id)
    {

        try {
            $services = PlaceOfService::find($id)->subServices;
        } catch (\ILLuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex->getMessage())->setData();

        }
        return $this->apiResponse->setSuccess(" Added to favorite Successfuly")->setData($services);

    }
    public function UpdateProfile($data)
    {
         try {
            $currentuser=$this->generalhelper->getcurrentUser();

            $user = User::find($currentuser->id)->update($data);
            
        } catch (\ILLuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError("Update Failed")->setData();
        }
        $user = User::find($currentuser->id);
        return $this->apiResponse->setSuccess("update Successfuly")->setData($user);

    }
    public function cities()
    {
        $cities = city::all();
        return $this->apiResponse->setSuccess("cities Successfuly")->setData($cities);

    }
    public function countries()
    {
        $countries = country::all();
        return $this->apiResponse->setSuccess("countries Successfuly")->setData($countries);

    }
    public function MyOrders(){
 
         try {
            $currentuser=$this->generalhelper->getcurrentUser();
            // $orders=User::where('id',$user->id)->load(['orders'=>function($query){
            //     $query->with( 'sub_Services'); 
            // }])->first();
            $user=User::where('id',$currentuser->id)->first();
            $or=$user->orders()->with(['sub_Services'=>function($query){
            $query->with('providers');

            }])->get();
        } catch (\ILLuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex)->setData();
        }
         return $this->apiResponse->setSuccess("your Orders")->setData($or);


    }
    public function MyFavorits(){
        try {
            $currentuser=$this->generalhelper->getcurrentUser();
            // $favorites=User::where('id',$user->id)->with(['favourites'=>function($query){
            //     $query->with('placeOfService');
            // }])->get();
            
            $user=User::where('id',$currentuser->id)->first();
            $favorites=$user->favourites()->with(['provider'=>function($query){
            $query->with('services');

            }])->get();
        } catch (\ILLuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError("favorites  Failed")->setData();
        }
        return $this->apiResponse->setSuccess("your favorites list")->setData($favorites);


    }
    public function showProviders($data){
       try {
            $providers = Provider::where('service_id', $data['service_id'])->where('city_id', $data['city_id'])->get();

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->apiResponse->setError($ex->getMessage())->setData();

        }
        return $this->apiResponse->setSuccess(" show Successfuly")->setData($providers);
    }
}
