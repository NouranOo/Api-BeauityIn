<?php

namespace App\Interfaces; 
use App\Http\Controllers\UserController;
 
interface UserInterface{

    public function create_user($data);
    public function login_user($data); 
    public function logout_user($data);
    public function showService();
    public function requestOrder ($data);
    public function getServiceplacesByCityId ($data);
    public function AddToFavorite ($data);
    public function DeleteFromFavorite ($data);
    public function getplaceserviceById ($id);
    public function UpdateProfile ($data);
    public function MyOrders();
    public function MyFavorits();
    public function cities ();
    public function countries ();
    public function showProviders($data);




}