<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 12:18 PM
 */

namespace App\Polymorphic;


class TraitTester {

    use AuthorizationTrait, AuthorizationTrait, FactoryTrait,
        InvokerTrait, RepositoryTrait, ResponderTrait, ValidatorTrait;



}