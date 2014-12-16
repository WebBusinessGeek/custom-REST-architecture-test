<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/15/14
 * Time: 4:45 PM
 */

namespace tests\UserDirectory;


use App\Polymorphic\TraitConcrete;
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


    /**
     *Test method returns User instance from database, otherwise an error message.
     */
    public function test_userInternalService_show_method()
    {
        //userService instance
        $userService = new UserInternalService();

        //create a user and store them in database and save response in variable
        $attr = [
            'email' => 'userInternalService@showMethodTest.com',
            'password' => 'testtest123456'
        ];

        $user = $userService->store($attr);

        //call show method using variable->id
        $userFromDB = $userService->show($user->id);

        //assert attributes
        $this->assertTrue($userFromDB->email == 'userInternalService@showMethodTest.com');
        $this->assertTrue($userFromDB->password == 'testtest123456');
        $this->assertTrue($user->id == $userFromDB->id);

        //delete user
        User::destroy($user->id);

        //call show method on bogus id
        $badShow = $userService->show('aaa');

        //assert error message
        $this->assertTrue('Model not found.' == $badShow);
    }

    /**
     *Test method updates a User model if attributes are valid and instance specified exists, otherwise returns error message.
     */
    public function test_userInternalService_update_method()
    {
        //userInternalService instance
        $userService = new UserInternalService();

        //create and store a new user instance and store response in variable
        $attr = [
            'email' => 'userInternalService@updateMethodTest.com',
            'password' => 'testtest123456'
        ];

        $newUser = $userService->store($attr);

        //assert its stored in the database and has correct attributes using variable->id
        $userFromDB = $userService->show($newUser->id);
        $this->assertEquals('userInternalService@updateMethodTest.com', $userFromDB->email);
        $this->assertEquals('testtest123456', $userFromDB->password);

        //call update method on stored instance using same variable->id and assert its changes
        $newAttr = [
            'email' => 'userInternalService@updateMethodTest2.com',
            'password' => 'testtest654321'
        ];

        $updatedUser = $userService->update($newUser->id, $newAttr);
        $this->assertEquals('userInternalService@updateMethodTest2.com', $updatedUser->email);
        $this->assertEquals('testtest654321', $updatedUser->password);

        //delete instance from database
        User::destroy($newUser->id);

        //assert error message on bad info
        $errorMsg = $userService->update('aaa', $newAttr);
        $this->assertEquals('Model not found.', $errorMsg);
    }


    /**
     *Test method deletes a User instance from database if instance specified exists, otherwise returns an error message.
     */
    public function test_userInternalService_destroy_method()
    {
        //userInternalService instance
        $userService = new UserInternalService();
        //create user and store in database, store response in variable
        $attr = [
            'email' => 'userInternalService@destroyMethodTest.com',
            'password' => 'testtest123456'
        ];

        $newUser = $userService->store($attr);

        //assert that its indeed store in the database using variable->id
        $userFromDB = $userService->show($newUser->id);
        $this->assertEquals('userInternalService@destroyMethodTest.com', $userFromDB->email);
        $this->assertEquals('testtest123456', $userFromDB->password);
        $this->assertEquals($newUser->id, $userFromDB->id);

        //call destroy method on instance
        $userService->destroy($newUser->id);

        //assert its no longer in the database
        $this->assertEquals('Model not found.', $userService->show($newUser));
    }
}
