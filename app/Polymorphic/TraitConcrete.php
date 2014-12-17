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

    use AuthorizationTrait, AuthorizationTrait,
         RepositoryTrait, ResponderTrait, ValidatorTrait;



    //tokenIsValid method- WORKING
    //dateIsValid method- not done
    //timeIsValid method- not done
    //dateTimeIsValid method- not done





































}