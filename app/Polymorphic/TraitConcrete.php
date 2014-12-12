<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 12:43 PM
 */

namespace App\Polymorphic;


class TraitConcrete {

    use AuthorizationTrait, AuthorizationTrait, FactoryTrait,
        InvokerTrait, RepositoryTrait, ResponderTrait, ValidatorTrait;

}