<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 2:31 PM
 */

namespace tests\Auth;


use App\Auth\Auth;
use App\Auth\AuthInternalService;
use App\UserDirectory\User;
use Illuminate\Foundation\Testing\TestCase;

class AuthInternalServiceTest extends \TestCase {

    /**
     *Test method stores a new auth if credentials are verified, otherwise error message.
     */
    public function test_authInternalService_store_method()
    {
//        //authInternalService instance
//        $authService = new AuthInternalService();
//
//        //create dummy users
//        $email1 = 'authInternalService@storeMethodTest1.com';
//        $password1 = 'testtest123456';
//        $email2 = 'authInternalService@storeMethodTest2.com';
//        $password2 = 'testtest654321';
//
//        $user1 = User::create([
//            'email' => $email1,
//            'password' => $password1
//        ]);
//
//        $user2 = User::create([
//            'email' => $email2,
//            'password' => $password2
//        ]);
//
//        //assert they are indeed in database
//        $userFromDB1 = User::find($user1->id);
//        $userFromDB2 = User::find($user2->id);
//
//        $this->assertEquals($email1, $userFromDB1->email);
//        $this->assertEquals($email2, $userFromDB2->email);
//
//        //good credential arrays
//        $good1 = [
//            'email' => $email1,
//            'password' => $password1
//        ];
//
//        $good2 = [
//            'email' => $email2,
//            'password' => $password2
//        ];
//
//        //bad credential arrays
//        $bad1 = [
//            'email' => $email1,
//            'password' => $password2
//        ];
//
//        $bad2 = [
//            'email' => $email2,
//            'password' => $password1
//        ];
//
//        //call store on good arrays and assert a Auth object is returned.
//        $goodResponse1 = $authService->store($good1);
//        $goodResponse2 = $authService->store($good2);
//
//        $authNameSpace = new Auth();
//        $this->assertEquals($authNameSpace->getClassName(), '\\'. get_class($goodResponse1));
//        $this->assertEquals($authNameSpace->getClassName(), '\\'. get_class($goodResponse2));
//
//        //delete Auth objects from database
//        Auth::destroy($goodResponse1->id);
//        Auth::destroy($goodResponse2->id);
//
//        //delete dummy users from database
//        User::destroy($user1->id);
//        User::destroy($user2->id);
//
//        //call store on bad arrays and assert an error message is returned.
    }

}
