<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHome()
	{
		return View::make('home');
	}

	public function noLoggedUser()
	{
		switch (Auth::user()->userable_type) {
			case 'Participant':
				return Redirect::route('participant.dashboard');
				break;
			case 'Admin':
				return Redirect::route('admin.dashboard');
				break;
		}
	}

}
