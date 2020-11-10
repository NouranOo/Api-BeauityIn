<?php
namespace App\Helpers;

use App\Models\Provider;
use App\Models\User;

class GeneralHelper
{
    protected static $currentUser;
    protected static $currentProvider;

    public static function SetCurrentUser($apitoken)
    {
        self::$currentUser = User::where('ApiToken', $apitoken)->first();

    }
    public  static function SetCurrentProvider($apitoken)
    {
        self::$currentProvider = Provider::where('ApiToken', $apitoken)->first();

    }
    public static function getcurrentUser()
    {
        return self::$currentUser;
    }
    public static function getcurrentProvider()
    {
        return  self::$currentProvider;
    }

}
