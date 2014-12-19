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
        //authInternalService instance
        $authService = new AuthInternalService();

        //create dummy users
        $email1 = 'authInternalService@storeMethodTest1.com';
        $password1 = 'testtest123456';
        $Hashpassword1 = password_hash($password1, PASSWORD_DEFAULT);
        $email2 = 'authInternalService@storeMethodTest2.com';
        $password2 = 'testtest654321';
        $Hashpassword2 = password_hash($password2, PASSWORD_DEFAULT);



        $user1 = User::create([
            'email' => $email1,
            'password' => $Hashpassword1
        ]);

        $user2 = User::create([
            'email' => $email2,
            'password' => $Hashpassword2
        ]);

        //assert they are indeed in database
        $userFromDB1 = User::find($user1->id);
        $userFromDB2 = User::find($user2->id);

        $this->assertEquals($email1, $userFromDB1->email);
        $this->assertEquals($email2, $userFromDB2->email);

        //good credential arrays
        $good1 = [
            'email' => $email1,
            'ipAddress' => '192.88.99.0',
            'password' => $password1
        ];

        $good2 = [
            'email' => $email2,
            'ipAddress' => '192.168.0.0',
            'password' => $password2
        ];

        //bad credential arrays
        $bad1 = [
            'email' => $email1,
            'ipAddress' => '192.88.99.3',
            'password' => $password2
        ];

        $bad2 = [
            'email' => $email2,
            'ipAddress' => '192.88.49.0',
            'password' => $password1
        ];

        //call store on good arrays and assert a Auth object is returned.
        $goodResponse1 = $authService->store($good1);
        $goodResponse2 = $authService->store($good2);

        $authNameSpace = new Auth();
        $this->assertEquals($authNameSpace->getClassName(), '\\'. get_class($goodResponse1));
        $this->assertEquals($authNameSpace->getClassName(), '\\'. get_class($goodResponse2));

        //call store on bad arrays and assert an error message is returned.
        $badResponse1 = $authService->store($bad1);
        $badResponse2 = $authService->store($bad2);

        $this->assertEquals('Invalid credentials.',$badResponse1);
        $this->assertEquals('Invalid credentials.', $badResponse2);

        //delete Auth objects from database
        Auth::destroy($goodResponse1->id);
        Auth::destroy($goodResponse2->id);

        //delete dummy users from database
        User::destroy($user1->id);
        User::destroy($user2->id);

    }


    /**
     *Test method returns specified instance. Otherwise returns an error.
     */
    public function test_authInternalService_show_method()
    {
        //authService instance
        $authService = new AuthInternalService();

        //create dummy user and auth and store in DB

        $user = User::create([
            'email' => 'authInternalService@showMethodTest.com',
            'password' => 'testtest123456'
        ]);

        $userId = $user->id;
        $ipAddress = '192.88.99.3';
        $publicToken = $authService->createPublicToken();
        $expireRate = 2;
        $expiresOn = $authService->createLoginExpirationDate($expireRate);
        $hashSecret = $authService->createSecretHash($authService->getModelDelimiter(),
                        $publicToken,$userId,$ipAddress);

        $auth = Auth::create([
            'userId' => $userId,
            'ipAddress' => $ipAddress,
            'publicToken' => $publicToken,
            'expiresOn' => $expiresOn,
            'hashSecret' => $hashSecret
        ]);

        $authId = $auth->id;

        //assert its indeed in the database
        $authFromDBPreTest = Auth::find($authId);
        $this->assertEquals($ipAddress, $authFromDBPreTest->ipAddress);
        $this->assertEquals($publicToken, $authFromDBPreTest->publicToken);

        //call show method and assert its attributes
        $authFromDB = $authService->show($authId);
        $this->assertEquals($ipAddress, $authFromDB->ipAddress);
        $this->assertEquals($publicToken, $authFromDB->publicToken);

        //delete instance from database
        Auth::destroy($authId);
        User::destroy($userId);

        //call show on bad id and assert error message
        $error = $authService->show('aaa');
        $this->assertEquals('Model not found.', $error);
    }


    /**
     *Test method deletes specified instance from auths table in database if it exists.
     * Otherwise return an error message
     */
    public function test_authInternalService_destroy_method()
    {
        //authService instance
        $authService = new AuthInternalService();

        //create a dummy user and auth

        $user = User::create([
            'email' => 'authInternalService@destroyMethodTest.com',
            'password' => 'testtest123456'
        ]);

        $userId = $user->id;
        $ipAddress = '192.88.99.3';
        $publicToken = $authService->createPublicToken();
        $expireRate = 2;
        $expiresOn = $authService->createLoginExpirationDate($expireRate);
        $hashSecret = $authService->createSecretHash($authService->getModelDelimiter(),
            $publicToken,$userId,$ipAddress);

        $auth = Auth::create([
            'userId' => $userId,
            'ipAddress' => $ipAddress,
            'publicToken' => $publicToken,
            'expiresOn' => $expiresOn,
            'hashSecret' => $hashSecret
        ]);

        $authId = $auth->id;

        //assert auth is indeed in database
        $authFromDB = Auth::find($authId);
        $this->assertEquals($ipAddress, $authFromDB->ipAddress);
        $this->assertEquals($publicToken, $authFromDB->publicToken);

        //call destroy method
        $this->assertTrue($authService->destroy($authId));

        //assert its removed from database
        $this->assertEquals('Model not found.', $authService->show($authId));

        //delete dummy user
        User::destroy($userId);
    }

}
