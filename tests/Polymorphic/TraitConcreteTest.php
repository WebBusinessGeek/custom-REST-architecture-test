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
     * Test if method returns true if passed in array keys are in model accepted attribute list, otherwise false.
     */
    public function test_validatorTrait_modelAcceptsAttributes_method()
    {
        //traitConcrete instance
        $trait = new TraitConcrete();

        //array to match
        $arrayToMatch = [
            'email',

            'password',

            'name'
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
     *Test if method returns true if all values in arrayToCheck
     * are set where keys from arrayToCheck match values from modelNonNullableAttributes array.
     * Otherwise false.
     */
    public function test_validatorTrait_modelNonNullableAttributesSet_method()
    {
        //trait instance
        $trait = new TraitConcrete();

        //array to match
        $arrayToMatch = [
            'needValue1',

            'needValue2',

            'needValue3'
        ];
        //good arrays to test
        $good1 = [
            'needValue1' => 'value',

            'needValue2' => 'value',

            'needValue3' => 'value'
        ];

        $good2 = [
            'needValue2' => 'value',

            'needValue1' => 'value',

            'needValue3' => 'value',

            'needValue4' => null,
        ];

        //bad arrays to test
        $bad1 = [
            'needValue1' => null,

            'needValue2' => 'value',

            'needValue3' => 'value'
        ];

        $bad2 = [
            'needValue1' => null,

            'needValue2' => 'value',

            'needValue3' => 'value',

            'needValue4' => 'value'
        ];

        //call modelNonNullableAttributesSet method on good arrays and assert true
        $this->assertTrue($trait->modelNonNullableAttributesSet($good1, $arrayToMatch));
        $this->assertTrue($trait->modelNonNullableAttributesSet($good2, $arrayToMatch));

        //call modelNonNullableAttributesSet method on bad arrays and assert false
        $this->assertFalse($trait->modelNonNullableAttributesSet($bad1, $arrayToMatch));
        $this->assertFalse($trait->modelNonNullableAttributesSet($bad2, $arrayToMatch));

    }

}
