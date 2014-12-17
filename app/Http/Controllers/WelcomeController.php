<?php namespace App\Http\Controllers;

use App\Auth\Auth;
use App\Polymorphic\TraitConcrete;
use App\UserDirectory\User;

class WelcomeController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');

		//trait instance
//		$trait = new TraitConcrete();
//
//		//array that will contain userId and authId, 'exists' set to their class name. Also include data with 'exists' set to null.
//		$modelAttr = [
//			0 => [
//
//				'name' => 'userId',
//
//				'format' => 'exists',
//
//				'nullable' => false,
//
//				'unique' => true,
//
//				'exists' => '\App\UserDirectory\User',
//
//				'enumValues' => [
//					'item1',
//					'item2',
//					'item3'
//				]
//			],
//
//			1 => [
//
//				'name' => 'authId',
//
//				'format' => 'exists',
//
//				'nullable' => false,
//
//				'unique' => true,
//
//				'exists' => '\App\Auth\Auth',
//
//				'enumValues' => [
//					'item1',
//					'item2',
//					'item3'
//				]
//			],
//
//			2 => [
//
//				'name' => 'password',
//
//				'format' => 'password',
//
//				'nullable' => false,
//
//				'unique' => true,
//
//				'exists' => null,
//
//				'enumValues' => [
//					'item1',
//					'item2',
//					'item3'
//				]
//			],
//
//			3 => [
//
//				'name' => 'email',
//
//				'format' => 'email',
//
//				'nullable' => false,
//
//				'unique' => true,
//
//				'exists' => null,
//
//				'enumValues' => [
//					'item1',
//					'item2',
//					'item3'
//				]
//			],
//
//		];
//
//		$userId = User::create([
//			'email' => 'validatorTrait@existsIsValidMethodTest.com',
//			'password' => 'testtest123456'
//		])->id;
//
//		$authId = \App\Auth\Auth::create([
//			'userId' => 1,
//
//			'ipAddress' => '123.020.2012',
//
//			'publicToken' => 'validatorTrait@existsIsValidMethodTest.com',
//
//			'expiresOn' => '2014-10-10 11:11:32',
//
//			'hashSecret' => 'sdkfjefoiwjoijdsflkjdlkj'
//		])->id;
//
//		//retrieve models from database using variablesId, assert they are indeed in the database
//		$userFromDB = User::find($userId);
//		$authFromDB = \App\Auth\Auth::find($authId);
//		//good
//
//		//create an array of attributes to pass to function with id's for User & Auth set to variables->id.
//		$goodAttr = [
//			'userId' => $userId,
//
//			'authId' => $authId,
//
//			'email' => 'validatorTrait@existsIsValidMethodTest2.com',
//
//			'password' => 'testtest123456'
//		];
//
//		//call the existsIsValid method on attribute array
//		dd($trait->existsIsValid($goodAttr, $modelAttr));
//
//
//		//delete user and auth instances
//		User::destroy($userId);
//		\App\Auth\Auth::destroy($authId);
//
//		//call the existsIsValid method on array with bogus id's and assert error message.
//		$badAttr = [
//			'userId' => 'aaa',
//
//			'authId' => 'aaa',
//
//			'email' => 'validatorTrait@existsIValidMethodTest2.com',
//
//			'password' => 'testtest123456'
//		];
//
//		dd($trait->existsIsValid($badAttr, $modelAttr));

	}

}
