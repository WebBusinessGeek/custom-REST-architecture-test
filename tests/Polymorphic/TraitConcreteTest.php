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
     * Test if method returns true if passed in array keys are in model accepted property list, otherwise false.
     */
    public function test_validatorTrait_modelAcceptsProperties_method()
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

        //call modelAcceptsProperties method on good arrays and assert true
        $this->assertTrue($trait->modelAcceptsProperties($good1, $arrayToMatch));
        $this->assertTrue($trait->modelAcceptsProperties($good2, $arrayToMatch));

        //call modelAcceptsProperties method on bad arrays and assert false
        $this->assertFalse($trait->modelAcceptsProperties($bad1, $arrayToMatch));
        $this->assertFalse($trait->modelAcceptsProperties($bad2, $arrayToMatch));
    }
}
