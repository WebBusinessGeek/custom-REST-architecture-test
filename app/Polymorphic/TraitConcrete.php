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

    public function avoidDuplicationOfUniqueData($credentials = array(), $modelAttributes = array(), $modelClassName)
    {
        $falseCounter = 0;
        $uniqueCheck = $this->getModelAttributeConfiguration($modelAttributes, 'unique');

        foreach($credentials as $key => $value)
        {
            if($uniqueCheck[$key] == true)
            {
                ($this->dataIsUnique($value, $key, $modelClassName))? : $falseCounter++;
            }
        }
        return ($falseCounter > 0) ? false: true;
    }














}