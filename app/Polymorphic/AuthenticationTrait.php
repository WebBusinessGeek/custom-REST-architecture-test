<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:50 AM
 */

namespace App\Polymorphic;


trait AuthenticationTrait {


    /**
     * Returns Eloquent model instance if login credentials are correct, otherwise false.
     * @param $keyValue
     * @param $identifierValue
     * @param $keyName
     * @param $identifierName
     * @param $className
     * @return bool or Model
     */
    public function confirmLoginCredentials($keyValue, $identifierValue, $keyName, $identifierName, $className)
    {
        $user = $className::where($identifierName, '=', $identifierValue)->first();
        return (password_verify($keyValue, $user->$keyName))? $user : false;
    }

}