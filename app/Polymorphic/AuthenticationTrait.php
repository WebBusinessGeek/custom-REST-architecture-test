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
     * Returns true if correct login credentials were passed, otherwise false.
     * @param $keyValue
     * @param $identifierValue
     * @param $keyName
     * @param $identifierName
     * @param $className
     * @return bool
     */
    public function confirmLoginCredentials($keyValue, $identifierValue, $keyName, $identifierName, $className)
    {
        $user = $className::where($identifierName, '=', $identifierValue)->first();
        return (password_verify($keyValue, $user->$keyName))? true : false;
    }

}