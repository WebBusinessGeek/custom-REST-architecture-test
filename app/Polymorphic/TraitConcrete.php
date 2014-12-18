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




    public function createPublicToken()
    {

    }

    public function createSecretHash($para1, $para2 = null, $para3 = null, $para4 = null)
    {
        $passwordHashed = password_hash($para1.$para2.$para3.$para4, PASSWORD_DEFAULT);

        $tokenHashed = uniqid('secretKey'. '_$krx2342387edw'. '$k./').$passwordHashed.'$k./'.mt_rand();

        return $tokenHashed;
    }

    public function createHash($para)
    {
        return password_hash($para, PASSWORD_DEFAULT);
    }








































}