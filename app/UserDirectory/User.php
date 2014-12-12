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
	 * Stores the models accepted attributes
	 * @var array
     */
	protected $acceptedAttributes =
		[
			'email',

			'password'
		];

	/**
	 * Stores the models non nullable attributes
	 * @var array
     */
	protected $nonNullableAttributes =
		[
			'email',

			'password'

		];

	/**
	 * Returns the models accepted attributes
	 * @return array
     */
	public function getAcceptedAttributes()
	{
		return $this->acceptedAttributes;
	}

	/**
	 * Returns the models Non nullable attributes
	 * @return array
     */
	public function getNonNullableAttributes()
	{
		return $this->nonNullableAttributes;
	}

}
