<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 12:43 PM
 */

namespace App\Polymorphic;


use App\UserDirectory\User;
use App\UserDirectory\UserInternalService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TraitConcrete {

    use AuthorizationTrait, AuthenticationTrait,
         RepositoryTrait, ResponderTrait, ValidatorTrait;




    public function hashHashAbleAttributes($credentialsOrAttributes = array())
    {
        $hashAbleAttributes = [ 'password', ];

        foreach($credentialsOrAttributes as $key => $value)
        {
            if(in_array($key, $hashAbleAttributes))
            {
                password_hash($value, PASSWORD_DEFAULT);
                $credentialsOrAttributes[$key] = $value;
            }
        }
        return $credentialsOrAttributes;
    }











































}