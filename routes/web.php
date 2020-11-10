<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return 'Hello in Beauty_In Api';
});
/**
 * UserAuth
 */
$router->group(['prefix'=>'Api/user'], function() use ($router){
    $router->post('/register','UserController@register');
    $router->post('/login','UserController@login');
    $router->post('/logout','UserController@logout');
    $router->post('/cities','UserController@cities');
    $router->post('/countries','UserController@countries');



});

$router->group(['prefix'=> 'Api/user' , 'middleware' => 'UserAuth'],function () use ($router){
    $router->post('/showServices','UserController@showServices');
    $router->post('/requestorder','UserController@requestOrder');
    $router->post('/updateprofile','UserController@updateprofile');
    $router->post('/place/service','UserController@getPlaceServices');
    $router->post('/AddToFavorite','UserController@AddToFavorite');
    $router->post('/DeleteFromFavorite','UserController@DeleteFromFavorite');
    $router->post('/MyOrders','UserController@MyOrders');
    $router->post('/MyFavorits','UserController@MyFavorits');
    $router->post('/showProviders','UserController@showProviders');



});

/**
 * ProviderAuth
 */
$router->group(['prefix'=>'Api/provider'], function() use ($router){
    $router->post('/register','ProviderController@register');
    $router->post('/login','ProviderController@login');
    $router->post('/logout','ProviderController@logout');
    $router->post('/Services','ProviderController@showServices');//get all service to choise while registering 
    $router->post('/cities','ProviderController@cities');
    $router->post('/countries','ProviderController@countries');
 
});


