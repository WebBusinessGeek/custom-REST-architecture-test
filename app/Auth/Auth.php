<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 1:21 PM
 */

namespace App\Auth;


use Illuminate\Database\Eloquent\Model;

class Auth extends Model{

    protected $fillable = [
        'userId', 'ipAddress', 'publicToken', 'expiresOn', 'hashSecret'
    ];
    //NEED TO REFACTOR THESE INTO  THEIR OWN CLASS FOR EASY EXTENSION


    protected $delimiter = '$kr.';

    protected $loginExpiration = 2;

    /**
     * Stores models attributes and their configuration values
     * @var array
     */
    protected $modelAttributes = [
//		START AT ZERO (0)!!! => [
//
//			'name' => 'nameOfAttribute',
//
//			'format' => '(choose 1: none, email, url, password,
//							 string, exists, enum, text, id, token, superToken, ipAddress, date, time, dataTime)',
//
//			'nullable' => false,
//
//			'unique' => true,
//
//          'exists' => null,

//          'identifier' => false,
//
//          'key' => false,
//
//			'enumValues' => [
//				'item1',
//				'item2',
//				'item3'
//			]
//		],

        0 => [

			'name' => 'userId',

			'format' => 'exists',

			'nullable' => false,

			'unique' => true,

            'exists' => '\App\UserDirectory\User',

            'identifier' => false,

            'key' => false,

			'enumValues' => [
				'item1',
				'item2',
				'item3'
			]
		],

        1 => [

            'name' => 'ipAddress',

            'format' => 'ipAddress',

            'nullable' => false,

            'unique' => true,

            'exists' => null,

            'identifier' => false,

            'key' => false,



        ],

        2 => [

            'name' => 'publicToken',

            'format' => 'token',

            'nullable' => false,

            'unique' => true,

            'exists' => null,

            'identifier' => true,

            'key' => false,

        ],

        3 => [

            'name' => 'expiresOn',

            'format' => 'dateTime',

            'nullable' => false,

            'unique' => false,

            'exists' => null,

            'identifier' => false,

            'key' => false,


        ],

        4 => [

            'name' => 'hashSecret',

            'format' => 'none',

            'nullable' => false,

            'unique' => true,

            'exists' => null,

            'identifier' => false,

            'key' => true,


        ],







    ];



    /**
     * Returns the models attributes and configuration values as multi-dimensional array.
     * @return array
     */
    public function getAttributes()
    {
        return $this->modelAttributes;
    }


    /**
     * Returns the models class as a string.
     * @return string
     */
    public function getClassName()
    {
        return '\\'. get_class($this);
    }


    /**
     * Returns the name of Attribute where the specified setting is set, otherwise error message is thrown.
     * @param $settingName
     * @return string
     */
    public function getAttributeWithSetting($settingName)
    {
        $answer = 'No setting by that name, has it been set?';
        $indefiniteBlock = 12;

        for($x = 0; $answer == 'No setting by that name, has it been set?' || $x > $indefiniteBlock; $x++)
        {
            (!$this->getAttributes()[$x][$settingName])
                ?
                :$answer = $this->getAttributes()[$x]['name'];
        }
        return $answer;
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getLoginExpiration()
    {
        return $this->loginExpiration;
    }


}

