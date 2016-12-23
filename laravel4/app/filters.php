<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		return Redirect::route('home');
	}
});

Route::filter('participant', function()
{
	if (Auth::user()->userable_type != 'Participant')
	{
		return Redirect::route('home');
	}
});

Route::filter('admin', function()
{
	if (Auth::user()->userable_type != 'Admin')
	{
		return Redirect::route('home');
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::route('home.dashboard');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
|--------------------------------------------------------------------------
| Exam Related Filter
|--------------------------------------------------------------------------
|
| Todo: make the repetitive redirect code to modular Class
|
*/

Route::filter('noExam', function() {
	$e = Auth::user()->userable->exam;

	// Check if user already have Exam
	// if they DO have Exam, then check their session
	if ($e ? $e->session != 0 : false)
	{
		if ($e->session == 1) {
			return Redirect::route('participant.exam.page');
		} elseif ($e->session == 2) {
			return Redirect::route('participant.exam.showConfirmFinish');
		} elseif ($e->session == 3) {
			return Redirect::route('participant.exam.result');
		}
	}
});

Route::filter('haveExam', function() {
	if (!Auth::user()->userable->exam) {
		return Redirect::route('participant.exam.preparation');
	}
});

Route::filter('inExam', function() {
	$e = Auth::user()->userable->exam;
	$s = $e->session;

	// Check user time
	$userEndTime = Carbon::parse($e->end_time);
	$now         = Carbon::now();
	$timeExpired = $now->gte($userEndTime);

	if($timeExpired) {
		$e->session = 2;
		$e->save();

		return Redirect::route('participant.exam.showConfirmFinish')
			->withMessage('exam_time_expired');
	}


	if ($s != 1)
	{
		if ($s == 0) {
			return Redirect::route('participant.exam.preparation');
		} elseif ($s == 2) {
			return Redirect::route('participant.exam.showConfirmFinish');
		} elseif ($s == 3) {
			return Redirect::route('participant.exam.result');
		}
	}
});

Route::filter('stopExam', function() {
	$e = Auth::user()->userable->exam;
	$s = $e->session;


	if ($s != 1 or $s != 2)
	{
		if ($s == 0) {
			return Redirect::route('participant.exam.preparation');
		} elseif ($s == 3) {
			return Redirect::route('participant.exam.result');
		}
	}
});

Route::filter('completedExam', function() {
	$e = Auth::user()->userable->exam;
	$s = $e->session;

	if ($e->session != 3)
	{
		if ($s == 0) {
			return Redirect::route('participant.exam.preparation');
		} elseif ($s == 1) {
			return Redirect::route('participant.exam.page');
		} elseif ($s == 2) {
			return Redirect::route('participant.exam.showConfirmFinish');
		}
	}
});