<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/22/14
 * Time: 1:26 PM
 */

namespace tests\UserDirectory;


use App\UserDirectory\User;
use App\UserDirectory\UserExternalService;
use Illuminate\Foundation\Testing\TestCase;

class UserExternalServiceTest extends \TestCase {

    /**
     *Test method stores a new user and returns the user if credentials are accepted, otherwise an error message.
     * Also all response must be in Json representation.
     */
    public function test_userExternalService_store_method()
    {
        //userService instance
        $userService = new UserExternalService();

        //good attributes for new user
        $goodAttr = [
            'email' => 'userExternalService@storeMethodTest.com',
            'password' => 'testtest123456',
        ];

        //bad attributes for new user
        $badAttr = [
            'email' => 'badEmail',
            'password' => 'badPassword',
        ];

        //call store method with good attributes and assert json success creation message (status code, and data)
        $goodResponse = $userService->store($goodAttr);
        $this->assertJson($goodResponse);
        $stdGoodResponse = json_decode($goodResponse);
        $this->assertEquals($userService->getSuccessCreationCode(),$stdGoodResponse->status);
        $this->assertEquals($goodAttr['email'], $stdGoodResponse->User->email);

        //call store method with bad attributes and assert json error message (statue code, and message)
        $badResponse = $userService->store($badAttr);
        $this->assertJson($badResponse);
        $stdBadResponse = json_decode($badResponse);
        $this->assertEquals($userService->getErrorCreationCode(), $stdBadResponse->status);
        $this->assertEquals('Error. Invalid attributes or duplicate data.', $stdBadResponse->Error);

        //delete new user
        User::destroy($stdGoodResponse->User->id);
    }
}
