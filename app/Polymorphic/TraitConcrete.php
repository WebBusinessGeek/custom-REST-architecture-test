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
        $defaults = [
            'minLength' => 0, 'minInteger' => 3, 'invalidCharacters' => '%^&*()-=_+{}[]\|?/><;'
        ];

        if(!isset($minLength))
        {
            $minLength = $defaults['minLength'];
        }
        if(!isset($minInteger))
        {
            $minInteger = $defaults['minInteger'];
        }
        if(!isset($invalidCharacters))
        {
            $invalidCharacters = $defaults['invalidCharacters'];
        }

        echo 'length: ' . $minLength . '<br/>' . 'integer: '. $minInteger.'<br/>'. 'char: '.$invalidCharacters;


    }


}