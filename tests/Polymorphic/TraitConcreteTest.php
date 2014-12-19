<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 12:44 PM
 */

//use \Illuminate\Foundation\Testing\TestCase;
use \App\Polymorphic\TraitConcrete;
use \App\UserDirectory\User;

class TraitConcreteTest extends \TestCase {

    /**
     * Test if method returns true if passed in array keys are accepted model attributes, otherwise false.
     */
    public function test_validatorTrait_modelAcceptsAttributes2_method()
    {
        //traitConcrete instance
        $trait = new TraitConcrete();

        //array to match
        $arrayToMatch = [
            0 => [
                'name' => 'email',

                'format' => 'email',

                'nullable' => false,

                'unique' => true,

                'enumValues' => [

                ]
            ],

            1 => [
                'name' => 'password',

                'format' => 'email',

                'nullable' => false,

                'unique' => true,

                'enumValues' => [

                ]
            ],

            2 => [
                'name' => 'name',

                'format' => 'email',

                'nullable' => false,

                'unique' => true,

                'enumValues' => [

                ]
            ],
        ];

        //good arrays to test
        $good1 = [

            'email' => 'someValue',

            'password' => 'someValue',

            'name' => 'someValue'

        ];

        $good2 = [

            'password' => 'someValue',

            'email' => 'someValue',

            'name' => 'someValue'

        ];

        //bad arrays to test
        $bad1 = [
            'email' => 'someValue',

            'password' => 'someValue',

            'wrongKey' => 'someValue'
        ];

        $bad2 = [
            'extraKey' => 'someValue',

            'password' => 'someValue',

            'name' => 'someValue',

            'email' => 'someValue'
        ];

        //call modelAcceptsAttributes method on good arrays and assert true
        $this->assertTrue($trait->modelAcceptsAttributes($good1, $arrayToMatch));
        $this->assertTrue($trait->modelAcceptsAttributes($good2, $arrayToMatch));

        //call modelAcceptsAttributes method on bad arrays and assert false
        $this->assertFalse($trait->modelAcceptsAttributes($bad1, $arrayToMatch));
        $this->assertFalse($trait->modelAcceptsAttributes($bad2, $arrayToMatch));
    }


    /**
     *Test method returns true if  mandatory values are set on arrayToCheck, otherwise false.
     *
     */
    public function test_validatorTrait_modelNonNullableAttributesSet_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //array to match
        $arrayToMatch = [
           0 => [
            'name' => 'needValue1',

			'format' => 'email',

			'nullable' => false,

			'unique' => true,

			'enumValues' => [

            ]
		],
            1 => [
                'name' => 'needValue2',

                'format' => 'key',

                'nullable' => false,

                'unique' => true,

                'enumValues' => [

                ]
            ],

            2 => [
                'name' => 'dontNeedValue',

                'format' => 'string',

                'nullable' => true,

                'unique' => true,

                'enumValues' => [

                ]
            ],
        ];
        //good arrays to test
        $good1 = [
            'needValue1' => 'value',

            'needValue2' => 'value',

            'dontNeedValue' => null,
        ];

        $good2 = [
            'needValue1' => 'value',

            'needValue2' => 'value',

            'dontNeedValue' => null,

            'extraValue' => 'value'
        ];

        //bad arrays to test
        $bad1 = [
            'needValue1' => null,

            'needValue2' => 'value',

            'dontNeedValue' => 'value'
        ];

        $bad2 = [
            'needValue1' => 'value',

            'needValue2' => null,

            'dontNeedValue' => 'value'
        ];

        //call modelNonNullableAttributesSet method on good arrays and assert true
        $this->assertTrue($trait->modelNonNullableAttributesSet($good1, $arrayToMatch));
        $this->assertTrue($trait->modelNonNullableAttributesSet($good2, $arrayToMatch));

        //call modelNonNullableAttributesSet method on bad arrays and assert false
        $this->assertFalse($trait->modelNonNullableAttributesSet($bad1, $arrayToMatch));
        $this->assertFalse($trait->modelNonNullableAttributesSet($bad2, $arrayToMatch));

    }

    /**
     *Test that method returns an array of attribute names associated with model.
     */
    public function test_invokerTrait_getModelAttributeNames_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //User model instance and assert it has $modelAttribute property set
        $user = new User();
        $this->assertTrue(is_array($user->getAttributes()));

        //assert getModelAttributeNames returns an array
        $this->assertTrue(is_array($trait->getModelAttributeNames($user->getAttributes())));
    }


    /**
     *Test method returns associative array of configuration values specified, otherwise throws an error.
     */
    public function test_invokerTrait_getModelAttributeConfiguration_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //User model instance and assert it has $modelAttribute property set
        $user = new User();
        $this->assertTrue(is_array($user->getAttributes()));

        //assertTrue getModelAttributeConfiguration returns an array with all valid configs
        $configs = [
            'name', 'nullable', 'format', 'unique', 'enumValues'
        ];
        foreach($configs as $config)
        {
            $this->assertTrue(is_array($trait->getModelAttributeConfiguration($user->getAttributes(), $config)));
        }

        //assertFalse getModelAttributeConfiguration throws an exception when invalid config as used.
        $this->setExpectedException('InvalidArgumentException', 'Configuration values invalid');
        $trait->getModelAttributeConfiguration($user->getAttributes(), 'error');

    }


    /**
     *Test method returns true if minimum length of characters is met, otherwise false.
     */
    public function test_validatorTrait_checkMinimumLengthMet()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good strings to check
        $good1 = 'lengthof10';
        $good2 = 'lengthof9';

        //bad strings to check
        $bad1 = 'length7';
        $bad2 = 'length';

        //call checkMinimumLengthMet and assert true on good strings
        $this->assertTrue($trait->checkMinimumLengthMet($good1, 9));
        $this->assertTrue($trait->checkMinimumLengthMet($good2, 9));

        //call checkMinimumLengthMet and assert false on bad strings
        $this->assertFalse($trait->checkMinimumLengthMet($bad1, 9));
        $this->assertFalse($trait->checkMinimumLengthMet($bad2, 9));
    }


    /**
     *Test method returns true if minimum amount of integers used in string met, otherwise false.
     */
    public function test_validatorTrait_checkMinimumIntegersMet()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good strings to check
        $good1 = '1234Integers';
        $good2 = 'one1two2three3four4five5';

        //bad strings to check
        $bad1 = '123Integers';
        $bad2 = 'noInteger';

        //call checkMinimumIntegersMet and assert true on good strings
        $this->assertTrue($trait->checkMinimumIntegersMet($good1, 4));
        $this->assertTrue($trait->checkMinimumIntegersMet($good2, 4));

        //call checkMinimumIntegersMet and assert false on bad strings
        $this->assertFalse($trait->checkMinimumIntegersMet($bad1, 4));
        $this->assertFalse($trait->checkMinimumIntegersMet($bad2, 4));

    }

    /**
     *Test method returns true if minimum amount of alpha characters are met, otherwise false.
     */
    public function test_validatorTrait_checkMinimumLettersMet()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good strings to check
        $good1 = '1234abca';
        $good2 = 'asdfjawoie1234';

        //bad strings to check
        $bad1 = 'a2343423891';
        $bad2 = '90909334';

        //call checkMinimumLettersMet and assert true on good strings
        $this->assertTrue($trait->checkMinimumLettersMet($good1, 4));
        $this->assertTrue($trait->checkMinimumLettersMet($good2, 4));

        //call checkMinimumLettersMet and assert false on bad strings
        $this->assertFalse($trait->checkMinimumLettersMet($bad1, 4));
        $this->assertFalse($trait->checkMinimumLettersMet($bad2, 4));
    }


    /**
     *Test method returns true if no invalid characters are set, otherwise false.
     */
    public function test_validatorTrait_ensureNoInvalidCharactersUsed()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good strings to check
        $good1 = '1234ab293840298sdfkjgseoica';
        $good2 = 'asdf03940293gokdjfgokejrojawoie1234';

        //bad strings to check
        $bad1 = 'a2343423891{}';
        $bad2 = '90909334$%^';

        //invalid characters
        $invalidChar = "/[$%^&*()\-_+={}|\\[\]:;\"'<>?,.\/]/";

        //call ensureNoInvalidCharactersUsed() and assert true on good strings
        $this->assertTrue($trait->ensureNoInvalidCharactersUsed($good1, $invalidChar));
        $this->assertTrue($trait->ensureNoInvalidCharactersUsed($good2, $invalidChar));

        //call ensureNoInvalidCharactersUsed() and assert false on bad strings
        $this->assertFalse($trait->ensureNoInvalidCharactersUsed($bad1, $invalidChar));
        $this->assertFalse($trait->ensureNoInvalidCharactersUsed($bad2, $invalidChar));
    }


    /**
     *Test password meets requirements (min. length, min. integers, min. letters, no invalid characters). Returns boolean.
     */
    public function test_validatorTrait_passwordIsValid_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good passwords to check
        $good1 = 'goodPassword1234';
        $good2 = 'anotherGoodPassword12345';

        //bad passwords to check
        $bad1 = 'bad1231231231';
        $bad2 = 'badder$#*$#*$&()}{';


        //call passwordIsValid() and assert true on good strings
        $this->assertTrue($trait->passwordIsValid($good1));
        $this->assertTrue($trait->passwordIsValid($good2));

        //call passwordIsValid() and assert false on bad strings
        $this->assertFalse($trait->passwordIsValid($bad1));
        $this->assertFalse($trait->passwordIsValid($bad2));
    }


    /**
     *Test method returns true is valid email format is used, otherwise false.
     */
    public function test_validatorTrait_emailIsValid_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good emails to test
        $good1 = 'someEmail@email.com';

        $good2 = 'anotherGood1234@email.me';

        //bad emails to test
        $bad1 = 'bad@email';

        $bad2 = 'reallyBad@.co';

        //call emailIsValid method on good emails and assert true
        $this->assertTrue($trait->emailIsValid($good1));
        $this->assertTrue($trait->emailIsValid($good2));

        //call emailIsValid method on bad emails and assert false
        $this->assertFalse($trait->emailIsValid($bad1));
        $this->assertFalse($trait->emailIsValid($bad2));
    }


    /**
     *Test method returns true if all valid formats are given, otherwise false.
     */
    public function test_validatorTrait_checkAllFormatsAreValid_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //model attributes mock array
        $modelAttributesMock = [
                0 => [
                'name' => 'email',

                'format' => 'email',

                'nullable' => false,

                'unique' => true,

                'enumValues' => [

                ]
            ],

                1 => [
                'name' => 'password',

                'format' => 'password',

                'nullable' => false,

                'unique' => false,

                'enumValues' => [

                ]
            ],

	    ];
        //good credentials associative array
        $good1 = [
            'email' => 'someEmail@email.com',

            'password' => 'goodPassword1234'
        ];

        $good2 = [
            'email' => 'someEmail@email.me',

            'password' => 'anotherGood443478347'
        ];

        //bad credentials associative array
        $bad1 = [
            'email' => 'someEmail@email',

            'password' => 'badPassword'
        ];

        $bad2 = [
            'email' => 'someEmail@.com',

            'password' => 'anotherBad$&*(%'
        ];

        //call checkAllFormatsAreValid method on good creds and assert true
        $this->assertTrue($trait->checkMajorFormatsAreValid($good1, $modelAttributesMock));
        $this->assertTrue($trait->checkMajorFormatsAreValid($good2, $modelAttributesMock));

        //call checkAllFormatsAreValid method on bad creds and assert false
        $this->assertFalse($trait->checkMajorFormatsAreValid($bad1, $modelAttributesMock));
        $this->assertFalse($trait->checkMajorFormatsAreValid($bad2, $modelAttributesMock));

    }


    /**
     *Test method returns true if value is unique to class, otherwise false
     */
    public function test_validatorTrait_dataIsUnique_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //save new user
        $user = User::create([
            'email' => 'validatorTrait@dataIsUniqueMethodTest.com',

            'password' => 'testtest1234',
        ]);

        $user->save();

        //call dataIsUnique and assert false on a saved user attribute
        $this->assertFalse($trait->dataIsUnique(
            'validatorTrait@dataIsUniqueMethodTest.com',
            'email',
            $user->getClassName()));


        //delete user from DB
        $user->delete();

        //call dataIsUnique and assert true on bad data
        $this->assertTrue($trait->dataIsUnique(
            'badEmail222@email.com',
            'email',
            $user->getClassName()));

    }

    /**
     *Test method returns true if all values are unique where necessary, otherwise false.
     */
    public function test_validatorTrait_avoidDuplicationOfUniqueData_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //save new user to database
        $user = User::create([
            'email' => 'validatorTrait@avoidDuplicationOfUniqueDataMethodTest.com',
            'password' => 'testtest1234'
        ]);

        //good credentials
        $good1 = [
            'email' => 'validatorTrait@avoidDuplicationOfUniqueDataMethodTest.com',
            'password' => 'testtest1234'
        ];

        //bad credentials
        $bad1 = [
            'email' => 'someOtherEmail3535353.com',
            'password' => 'tjsldkjfk2349389203'
        ];

        //call avoidDuplicationOfUniqueData method using good credentials and assertFalse
        $this->assertFalse($trait->avoidDuplicationOfUniqueData($good1, $user->getAttributes(),$user->getClassName()));

        //delete the user from db
        $user->delete();

        //call avoidDuplicationOfUniqueData method on bad credentials and assert true.
        $this->assertTrue($trait->avoidDuplicationOfUniqueData($bad1, $user->getAttributes(), $user->getClassName()));

    }


    /**
     *Test method returns a new instance of a model class.
     */
    public function test_repositoryTrait_createNewModel()
    {
        //trait instance
        $trait = new TraitConcrete();

        //instance to make test dynamic to location of class and avoid clashes later.
        $user = new User();

        //call createNewModel() function and store in variable
        $testModel = $trait->createNewModel('\\'. get_class($user));

        //assert that model exists
        $this->assertTrue('\\' . get_class($testModel) == '\\'. get_class($user));

    }


    /**
     *Test method adds passed in attributes to specified model and returns the instance.
     */
    public function test_invokerTrait_addAttributesToModel_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //attributes
        $attr = [
            'email' => 'invokerTrait@addAttributesToModelMethodTest.com',
            'password' => 'testtest12345'
        ];

        //call addAttributesToModel and store repsonse in variable
        $userForDynamicTesting = new User();

        $userToTest = $trait->addAttributesToNewModel($attr, $userForDynamicTesting->getClassName());

        //assert variable's attributes and class name
        $this->assertEquals('invokerTrait@addAttributesToModelMethodTest.com', $userToTest->email);
        $this->assertEquals('testtest12345', $userToTest->password);
        $this->assertEquals($userForDynamicTesting->getClassName(), '\\'.get_class($userToTest));

    }


    /**
     *Test method stores an Eloquent model in its database table.
     */
    public function test_repositoryTrait_storeEloquentModelInDatabase_method()
    {
        //trait concrete
        $trait = new TraitConcrete();

        //create user with attributes
        $user = User::create([
            'email' => 'repositoryTrait@storeEloquentModelInDatabase.com',
            'password' => 'testtest12345'
        ]);

        //call storeEloquentModelInDatabase method on user and store in variable.
        $userStored = $trait->storeEloquentModelInDatabase($user);

        //user variable->id to retrieve the user from the database and assert its attributes.
        $userFromDatabase = User::find($userStored->id);
        $this->assertTrue($userFromDatabase->email == 'repositoryTrait@storeEloquentModelInDatabase.com');
        $this->assertTrue($userFromDatabase->password == 'testtest12345');
        $this->assertTrue($userFromDatabase->id == $userStored->id);

        //delete the user from the database table
        User::destroy($userStored->id);
    }


    /**
     *Test method returns the eloquent model specified, otherwise returns an error message.
     */
    public function test_repositoryTrait_getEloquentModelFromDatabase_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //create user and store in database and store response in variable
        $attr =
            [
                'email' => 'repositoryTrait@getEloquentModelFromDatabaseMethodTest.com',
                'password' => 'testtest123456'
            ];

        $userForNameSpace = new User();

        $newUser = $trait->storeEloquentModelInDatabase($trait->addAttributesToNewModel($attr,$userForNameSpace->getClassName()));

        //call getEloquentModelFromDatabase using variable->id and variable->getClassName
        $userFromDB = $trait->getEloquentModelFromDatabase($newUser->id, $userForNameSpace->getClassName());

        //assert instance's attributes and id
        $this->assertEquals($userFromDB->email, 'repositoryTrait@getEloquentModelFromDatabaseMethodTest.com');
        $this->assertTrue($userFromDB->password == 'testtest123456');
        $this->assertTrue($userFromDB->id == $newUser->id);

        //delete user from database
        User::destroy($userFromDB->id);

        //call getEloquentModelFromDatabase on bad id and assert error message.
        $badId = $trait->getEloquentModelFromDatabase('aaa', $userForNameSpace->getClassName());
        $this->assertTrue($badId == 'Model not found.');


    }


    /**
     *Test method adds passed in attributes to existing model
     */
    public function test_invokerTrait_addAttributesToExistingModel_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //create user and save in database and store in variable
        $userNameSpace = new User();
        $attr = [
            'email' => 'invokerTrait@addAttributesToExistingModelMethodTest.com',
            'password' => 'testtest123456'
        ];

        $userToStore = $trait->storeEloquentModelInDatabase($trait->addAttributesToNewModel($attr, $userNameSpace->getClassName()));

        //assert user is in database and assert its attributes using variable->id
        $userFromDB = $trait->getEloquentModelFromDatabase($userToStore->id, $userNameSpace->getClassName());
        $this->assertEquals('invokerTrait@addAttributesToExistingModelMethodTest.com', $userFromDB->email);
        $this->assertEquals('testtest123456', $userFromDB->password);
        $this->assertEquals($userToStore->id, $userFromDB->id);

        //call addAttributesToExistingModel method on user from db
        $newAttr = [
            'email' => 'invokerTrait@addAttributesToExistingModelMethodTest2.com',
            'password' => 'testtest654321'
        ];

        $userUpdated = $trait->addAttributesToExistingModel($userFromDB,$newAttr);

        //assert its changed attributes
        $this->assertEquals('invokerTrait@addAttributesToExistingModelMethodTest2.com', $userFromDB->email);
        $this->assertEquals('testtest654321', $userFromDB->password);

        //delete user from database
        User::destroy($userToStore->id);
    }


    /**
     *Test method deletes a Eloquent model from the database.
     */
    public function test_repositoryTrait_deleteEloquentModelFromDatabase_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //create user and store in database, store response in variable
        $attr = [
            'email' => 'repositoryTrait@deleteEloquentModelFromDatabase.com',
            'password' => 'testtest123456'
        ];

        $userNameSpace = new User();

        $userStored = $trait->storeEloquentModelInDatabase($trait->addAttributesToNewModel($attr, $userNameSpace->getClassName()));

        //assert its in database using variable->id
        $userFromDb = $trait->getEloquentModelFromDatabase($userStored->id, $userNameSpace->getClassName());
        $this->assertEquals('repositoryTrait@deleteEloquentModelFromDatabase.com', $userFromDb->email);
        $this->assertEquals('testtest123456', $userFromDb->password);
        $this->assertEquals($userStored->id , $userFromDb->id);

        //call deleteEloquentModelFromDatabase method on variable->id
        $trait->deleteEloquentModelFromDatabase($userFromDb, $userNameSpace->getClassName());

        //assert its no longer in database
        $proveDelete = $trait->getEloquentModelFromDatabase($userStored->id, $userNameSpace->getClassName());
        $this->assertEquals('Model not found.', $proveDelete);
    }

    /**
     *Test method returns true if instance specified exists, otherwise false.
     */
    public function test_validatorTrait_existsIsValid_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //array that will contain userId and authId, 'exists' set to their class name. Also include data with 'exists' set to null.
        $modelAttr = [
            0 => [

                'name' => 'userId',

                'format' => 'exists',

                'nullable' => false,

                'unique' => true,

                'exists' => '\App\UserDirectory\User',

                'enumValues' => [
                    'item1',
                    'item2',
                    'item3'
                ]
            ],

            1 => [

                'name' => 'authId',

                'format' => 'exists',

                'nullable' => false,

                'unique' => true,

                'exists' => '\App\Auth\Auth',

                'enumValues' => [
                    'item1',
                    'item2',
                    'item3'
                ]
            ],

            2 => [

                'name' => 'password',

                'format' => 'password',

                'nullable' => false,

                'unique' => true,

                'exists' => null,

                'enumValues' => [
                    'item1',
                    'item2',
                    'item3'
                ]
            ],

            3 => [

                'name' => 'email',

                'format' => 'email',

                'nullable' => false,

                'unique' => true,

                'exists' => null,

                'enumValues' => [
                    'item1',
                    'item2',
                    'item3'
                ]
            ],

        ];
        //create a new user and auth and store them in the database - keep responses in variables.
        $userId = User::create([
            'email' => 'validatorTrait@existsIsValidMethodTest.com',
            'password' => 'testtest123456'
        ])->id;

        $authId = \App\Auth\Auth::create([
            'userId' => 1,

            'ipAddress' => '123.020.2012',

            'publicToken' => 'validatorTrait@existsIsValidMethodTest.com',

            'expiresOn' => '2014-10-10 11:11:32',

            'hashSecret' => 'sdkfjefoiwjoijdsflkjdlkj'
        ])->id;

        //retrieve models from database using variablesId, assert they are indeed in the database
        $userFromDB = User::find($userId);
        $authFromDB = \App\Auth\Auth::find($authId);
        $this->assertEquals('validatorTrait@existsIsValidMethodTest.com', $userFromDB->email);
        $this->assertEquals('validatorTrait@existsIsValidMethodTest.com', $authFromDB->publicToken);


        //create an array of attributes to pass to function with id's for User & Auth set to variables->id.
        $goodAttr = [
            'userId' => $userId,

            'authId' => $authId,

            'email' => 'validatorTrait@existsIsValidMethodTest2.com',

            'password' => 'testtest123456'
        ];

        //call the existsIsValid method on attribute array
        $this->assertTrue($trait->existsIsValid($goodAttr, $modelAttr));


        //delete user and auth instances
        User::destroy($userId);
        \App\Auth\Auth::destroy($authId);

        //call the existsIsValid method on array with bogus id's and assert error message.
        $badAttr = [
            'userId' => 'aaa',

            'authId' => 'aaa',

            'email' => 'validatorTrait@existsIValidMethodTest2.com',

            'password' => 'testtest123456'
        ];

        $this->assertFalse($trait->existsIsValid($badAttr, $modelAttr));
    }


    /**
     *Test method returns true if ip address is in valid format, otherwise false.
     */
    public function test_validatorTrait_ipAddressIsValid_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //good ipAddresses
        $good = [
            '192.88.99.0',
            '192.168.0.0',
            '198.18.0.0',
            '198.51.100.0',
            '203.0.113.0'
        ];
        //bad ipAddresses
        $bad = [
            '12345',
            '103.10239321',
            '103.9',
            '98.99',
            '90.89.89'
        ];

        //run ipAddressIsValid on good addresses and assert true
        foreach($good as $testIp)
        {
            $this->assertTrue($trait->ipAddressIsValid($testIp));
        }

        //run ipAddressIsValid on bad addresses and assert false
        foreach($bad as $testIp)
        {
            $this->assertFalse($trait->ipAddressIsValid($testIp));
        }

    }


    /**
     *Test method returns Model instance if correct credentials used, otherwise false.
     */
    public function test_authenticationTrait_confirmLoginCredentials_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //create and store user
        $userId = User::create([
            'email' => 'authenticationTrait@confirmLoginCredentialsMethodTest.com',
            'password' => password_hash('testtest123456', PASSWORD_DEFAULT)
        ])->id;

        //confirm user is in database
        $userFromDB = User::find($userId);
        $this->assertEquals('authenticationTrait@confirmLoginCredentialsMethodTest.com', $userFromDB->email);


        $userNameSpace = new User();
        //call confirmLoginCredentials on valid credentials and assert instance returned.
        $goodResponse = $trait->confirmLoginCredentials('testtest123456', 'authenticationTrait@confirmLoginCredentialsMethodTest.com',
                                        'password', 'email', $userNameSpace->getClassName());

        $this->assertTrue('\\'.get_class($goodResponse) == $userNameSpace->getClassName());

        //call confirmLoginCredentials on invalid password and assert False.
        $badResponse = $trait->confirmLoginCredentials('testtest1234', 'authenticationTrait@confirmLoginCredentialsMethodTest.com',
            'password', 'email', $userNameSpace->getClassName());

        $this->assertFalse($badResponse);

        //delete user
        User::destroy($userId);
    }

    /**
     *Test functions returns true if passed in secret is correct.
     */
    public function test_authenticationTrait_secretHashVerify_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //create a secret hash
        $secret = 'authenticationTrait@secretHashVerifyMethodTest';
        $delimiter = '$rrbb';
        $hashSecret = $trait->createSecretHash($delimiter, $secret);

        //call secretHashVerify on correct credentials and assert true
        $this->assertTrue($trait->secretHash_verify($secret, $hashSecret, $delimiter));

        //call secretHashVerify on incorrect credentials and assert false.
        $this->assertFalse($trait->secretHash_verify('notCorrect', $hashSecret, $delimiter));
    }


    /**
     *Test method returns equal to now +  $x hours.
     */
    public function test_authenticationTrait_createLoginExpirationDate_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //date with current time
        $currentTime = new DateTime();

        //call createLoginExpirationDate and store in variable
        $hoursAhead = '3';
        $newTime = $trait->createLoginExpirationDate($hoursAhead);

        //assert createLoginExpirationDate is $hourAhead more than current time
        $this->assertEquals($hoursAhead, $currentTime->diff($newTime)->h);

    }



}
