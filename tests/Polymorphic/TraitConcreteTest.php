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
     *Test password meets requirements (min. length, min. integers, no invalid characters). Returns boolean.
     */
    public function test_validatorTrait_passwordIsValid_method()
    {

    }

}
