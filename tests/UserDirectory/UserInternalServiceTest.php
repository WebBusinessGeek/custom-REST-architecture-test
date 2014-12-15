<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/15/14
 * Time: 4:45 PM
 */

namespace tests\UserDirectory;


use App\UserDirectory\User;
use App\UserDirectory\UserInternalService;
use Illuminate\Foundation\Testing\TestCase;

class UserInternalServiceTest extends \TestCase{


    /**
     *Test method stores and returns a new User instance if all checks pass, otherwise returns an error message.
     */
    public function test_userInternalService_store_method()
    {
        //internal service
        $userService = new UserInternalService();

        //good credentials/attributes to pass
        $good = [
            'email' => 'userInternalService@storeMethodTest.com',
            'password' => 'testtest123456'
        ];

        //bad credentials/attributes to pass
        $bad1 = [
            'email' => 'badEamil.com',
            'password' => 'testtest123456'
        ];

        $bad2 = [
            'email' => 'goodEmail12345@email.com',
            'password' => 'badPassword'
        ];

        //call store on good array and assert model was stored.
        $userGood = $userService->store($good);
        $userFromDB = User::find($userGood->id);
        $this->assertTrue($userFromDB->email == 'userInternalService@storeMethodTest.com');
        $this->assertTrue($userFromDB->password == 'testtest123456');
        $this->assertTrue($userFromDB->id == $userGood->id);

        //delete user
        User::destroy($userGood->id);

        //call store on bad array and assert error message.
        $userBad1 = $userService->store($bad1);
        $userBad2 = $userService->store($bad2);
        $this->assertEquals('Error. Invalid attributes or duplicate data.', $userBad1);
        $this->assertEquals('Error. Invalid attributes or duplicate data.', $userBad2);

    }
}
