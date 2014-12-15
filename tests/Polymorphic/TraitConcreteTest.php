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
        $this->assertTrue(is_array($user->getModelAttributes()));

        //assert getModelAttributeNames returns an array
        $this->assertTrue(is_array($trait->getModelAttributeNames($user->getModelAttributes())));
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
        $this->assertTrue(is_array($user->getModelAttributes()));

        //assertTrue getModelAttributeConfiguration returns an array with all valid configs
        $configs = [
            'name', 'nullable', 'format', 'unique', 'enumValues'
        ];
        foreach($configs as $config)
        {
            $this->assertTrue(is_array($trait->getModelAttributeConfiguration($user->getModelAttributes(), $config)));
        }

        //assertFalse getModelAttributeConfiguration throws an exception when invalid config as used.
        $this->setExpectedException('InvalidArgumentException', 'Configuration values invalid');
        $trait->getModelAttributeConfiguration($user->getModelAttributes(), 'error');

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
        $this->assertTrue($trait->checkAllFormatsAreValid($good1, $modelAttributesMock));
        $this->assertTrue($trait->checkAllFormatsAreValid($good2, $modelAttributesMock));

        //call checkAllFormatsAreValid method on bad creds and assert false
        $this->assertFalse($trait->checkAllFormatsAreValid($bad1, $modelAttributesMock));
        $this->assertFalse($trait->checkAllFormatsAreValid($bad2, $modelAttributesMock));

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
        $this->assertFalse($trait->avoidDuplicationOfUniqueData($good1, $user->getModelAttributes(),$user->getClassName()));

        //delete the user from db
        $user->delete();

        //call avoidDuplicationOfUniqueData method on bad credentials and assert true.
        $this->assertTrue($trait->avoidDuplicationOfUniqueData($bad1, $user->getModelAttributes(), $user->getClassName()));

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

        $userToTest = $trait->addAttributesToModel($attr, $userForDynamicTesting->getClassName());

        //assert variable's attributes and class name
        $this->assertEquals('invokerTrait@addAttributesToModelMethodTest.com', $userToTest->email);
        $this->assertEquals('testtest12345', $userToTest->password);
        $this->assertEquals($userForDynamicTesting->getClassName(), '\\'.get_class($userToTest));

    }

}
