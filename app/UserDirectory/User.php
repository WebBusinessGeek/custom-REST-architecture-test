<?php namespace App\UserDirectory;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];





	//NEED TO REFACTOR THESE INTO  THEIR OWN CLASS FOR EASY EXTENSION

	/**
	 * Stores models minimum password length.
	 * @var int
     */
	protected $minimumPasswordLength = 10;

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
//							 string, exists, enum, text, id, token, ipAddress, date)',
//
//			'nullable' => false,
//
//			'unique' => true,
//
//			'exists' => null,
//
//          'identifier' => false,
//
//          'key' => false,
//
//
//			'enumValues' => [
//				'item1',
//				'item2',
//				'item3'
//			]
//		],


		0 => [
			'name' => 'email',

			'format' => 'email',

			'nullable' => false,

			'unique' => true,

			'exists' => null,

			'identifier' => true,

			'key' => false,

			'enumValues' => [

			]
		],

		1 => [
			'name' => 'password',

			'format' => 'password',

			'nullable' => false,

			'unique' => false,

			'exists' => null,

			'identifier' => false,

			'key' => true,

			'enumValues' => [

			]
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
	 * Returns the models minimum password length.
	 * @return int
	 */
	public function getMinimumPasswordLength()
	{
		return $this->minimumPasswordLength;
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


}
