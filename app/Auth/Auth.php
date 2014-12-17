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


    /**
     * Stores models attributes and their configuration values
     * @var array
     */
    protected $modelAttributes = [
//		START AT ZERO (0)!!! => [
//
//			'name' => 'nameOfAttribute',
//
//			'format' => '(choose 1: email, url, password,
//							 string, exists, enum, text, id, token, superToken, ipAddress, date, time, dataTime)',
//
//			'nullable' => false,
//
//			'unique' => true,
//
//          'exists' => null,
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


        ],

        2 => [

            'name' => 'publicToken',

            'format' => 'token',

            'nullable' => false,

            'unique' => true,

            'exists' => null,


        ],

        3 => [

            'name' => 'expiresOn',

            'format' => 'dateTime',

            'nullable' => false,

            'unique' => false,

            'exists' => null,


        ],

        4 => [

            'name' => 'hashSecret',

            'format' => 'superToken',

            'nullable' => false,

            'unique' => true,

            'exists' => null,


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


}

