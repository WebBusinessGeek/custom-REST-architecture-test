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



    public function passwordIsValid($passwordToCheck, $minLength = null, $minInteger = null, $invalidCharacters = null)
    {
        //ensure defaults are set
        $defaults = [
            'minLength' => 10,

            'minInteger' => 3,

            'invalidCharacters' => '%,^,&,*,(,),{,},[,],|,\,;,:,",\',<,>,\,,.,?,/,~,`',
        ];

        foreach($defaults as $key => $value)
        {
            if(!isset(${$key}))
            {
                ${$key} = $value ;
            }
        }

        //check minimum length

        //check minimum integers

        //check for invalid characters

    }


}