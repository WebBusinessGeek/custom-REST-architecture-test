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

class TraitConcrete {

    use AuthorizationTrait, AuthorizationTrait, FactoryTrait,
         RepositoryTrait, ResponderTrait, ValidatorTrait;


    //place values on model by its keys - Working

    public function addAttributesToModel($credentials = array(), $className)
    {
        //create new model

        //foreach run addSingleAttributeToModel
    }




















}