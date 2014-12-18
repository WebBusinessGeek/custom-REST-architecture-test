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
//		return view('welcome');


		$trait = new TraitConcrete();

		$tokenHashed = $trait->createSecretHash('kevinman', 'kevinman');

//		dd(password_hash('kev', PASSWORD_DEFAULT));

		$exploded = explode('$k./', $tokenHashed);
		$first60 = substr($exploded[1], 13, 60);
		$response = password_verify('kevinmankevinman',$first60);
		return $tokenHashed. var_dump($exploded).var_dump($first60). var_dump($response);



//		dd($exploded);




	}

}
