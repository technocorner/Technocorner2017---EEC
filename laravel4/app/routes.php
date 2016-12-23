<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
  'before' => 'guest',
  'as' => 'home',
  'uses' => 'HomeController@showHome'
));

Route::get('home', function() {
    return Redirect::route('home');
});

// Route used to prevent already logged that try to access home/login page
// They wil be redirected to their respected dashboard (Admin or Participant alike)
Route::get('dashboard', [
  'as' => 'home.dashboard',
  'uses' => 'HomeController@noLoggedUser'
]);



/*
|--------------------------------------------------------------------------
| Participan Routes
|--------------------------------------------------------------------------
|
| Here all the routes for Participant Model
|
*/

Route::group(['before' => 'guest'], function()
{

  Route::get('user/daftar', array(
    'as'  => 'participant.create',
    'uses' => 'ParticipantController@create'
  ));

  Route::post('user/simpan', array(
    'as'  => 'participant.store',
    'uses' => 'ParticipantController@store'
  ));

  Route::post('user/login', [
    'as' => 'participant.login',
    'uses' => 'ParticipantController@login'
  ]);

});

// Login participant
Route::group(['before' => 'auth|participant'], function() {

  Route::get('user', [
    'as' => 'participant.dashboard',
    'uses' => 'ParticipantController@dashboard'
  ]);

  Route::get('user/logout', [
    'as' => 'participant.logout',
    'uses' => 'ParticipantController@logout'
  ]);

  Route::get('user/exam/preparation', [
    'before' => 'noExam',
    'as' => 'participant.exam.preparation',
    'uses' => 'ExamController@showPreparation'
  ]);

  Route::get('user/exam/start', [
    'as' => 'participant.exam.start',
    'uses' => 'ExamController@startExam',
  ]);

  Route::get('user/exam', [
    'before' => 'haveExam|inExam',
    'as' => 'participant.exam.page',
    'uses' => 'ExamController@exam'
  ]);

  Route::any('user/exam/result/confirm', [
    'before' => 'haveExam|stopExam',
    'as' => 'participant.exam.showConfirmFinish',
    'uses' => 'ExamController@showConfirmFinish'
  ]);

  Route::get('user/exam/finish', [
    'before' => 'haveExam|completedExam',
    'as' => 'participant.exam.result',
    'uses' => 'ExamController@result'
  ]);

  Route::get('user/exam/timer', [
      'as' => 'participant.exam.timer',
      'uses' => 'ExamController@timeSync'
  ]);

  Route::post('user/exam/submit', [
    'as' => 'participant.exam.submit',
    'uses' => 'ExamController@submit'
  ]);

  Route::post('user/exam/result/process', [
    'before' => 'haveExam',
    'as' => 'participant.exam.confirmFinish',
    'uses' => 'ExamController@confirmFinish'
  ]);

  // DEVELOPER MODE ONLY
  Route::get('user/exam/destroy', [
    'as' => 'participant.exam.destroy',
    'uses' => 'ExamController@destroy'
  ]);

});

  Route::get('user/exam/get-answer', [
    'uses' => 'ExamController@getAnswer'
  ]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here all the routes for Admin Model
|
*/

Route::group(['before' => 'guest'], function()
{

  Route::get('admin-tc', [
    'as' => 'admin.home',
    'uses' => 'AdminController@home'
  ]);

  Route::post('admin-tc/login', [
    'as' => 'admin.login',
    'uses' => 'AdminController@login'
  ]);

  Route::get('admin-tc/daftar', [
    'as' => 'admin.create',
    'uses' => 'AdminController@create'
  ]);

  Route::post('admin-tc/daftar/simpan', [
    'as' => 'admin.store',
    'uses' => 'AdminController@store'
  ]);

});

Route::group(['before' => 'auth|admin'], function()
{

  Route::get('admin-tc/logout', [
    'as' => 'admin.logout',
    'uses' => 'AdminController@logout'
  ]);

  Route::get('admin-tc/dashboard', [
    'as' => 'admin.dashboard',
    'uses' => 'AdminController@dashboard'
  ]);

  // Participant related routes

  Route::get('admin-tc/dashboard/peserta', [
    'as' => 'admin.viewAllParticipant',
    'uses' => 'AdminController@viewAllParticipant'
  ]);

  Route::get('admin-tc/dashboard/peserta/{id}', [
    'as' => 'admin.viewDetailParticipant',
    'uses' => 'AdminController@viewDetailParticipant'
  ])->where('id', '[0-9]+');


  Route::get('admin-tc/dashboard/peserta', [
    'as' => 'admin.participant.list',
    'uses' => 'AdminController@viewAllParticipant'
  ]);

  Route::get('admin-tc/dashboard/participant/create', [
    'as' => 'admin.participant.create',
    'uses' => 'AdminController@createParticipant'
  ]);

  Route::post('admin-tc/dashboard/participant/store', [
    'as' => 'admin.participant.store',
    'uses' => 'AdminController@storeParticipant'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/participant/massCreate', [
    'as' => 'admin.participant.massCreate',
    'uses' => 'AdminController@massCreateParticipant'
  ]);

  Route::post('admin-tc/dashboard/participant/massStore', [
    'as' => 'admin.participant.massStore',
    'uses' => 'AdminController@massStoreParticipant'
]);

  Route::get('admin-tc/dashboard/participant/{id}', [
    'as' => 'admin.participant.detail',
    'uses' => 'AdminController@viewDetailParticipant'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/participant/{id}/edit', [
    'as' => 'admin.participant.edit',
    'uses' => 'AdminController@editParticipant'
  ])->where('id', '[0-9]+');

  Route::post('admin-tc/dashboard/participant/{id}/update', [
    'as' => 'admin.participant.update',
    'uses' => 'AdminController@updateParticipant'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/participant/{id}/delete', [
    'as' => 'admin.participant.delete',
    'uses' => 'AdminController@deleteParticipant'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/participant/{id}/exam/delete', [
    'as' => 'admin.deleteExamParticipant',
    'uses' => 'AdminController@deleteExamParticipant'
  ])->where('id', '[0-9]+');


    Route::get('admin-tc/dashboard/participant/delete-all', [
      'uses' => 'AdminController@dropParticipant'
    ]);

  // Question CRUD related routes

  Route::get('admin-tc/dashboard/soal/tambah', [
    'as' => 'admin.question.create',
    'uses' => 'QuestionController@create'
  ]);

  Route::post('admin-tc/dashboard/soal/simpan', [
    'as' => 'admin.question.store',
    'uses' => 'QuestionController@store'
  ]);

  Route::get('admin-tc/dashboard/soal/{id}', [
    'as' => 'admin.question.detail',
    'uses' => 'QuestionController@detail'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/soal/{id}/edit', [
    'as' => 'admin.question.edit',
    'uses' => 'QuestionController@edit'
  ])->where('id', '[0-9]+');

  Route::post('admin-tc/dashboard/soal/{id}/perbarui', [
    'as' => 'admin.question.update',
    'uses' => 'QuestionController@update'
  ])->where('id', '[0-9]+');

  Route::get('admin-tc/dashboard/soal/{id}/hapus', [
    'as' => 'admin.question.delete',
    'uses' => 'QuestionController@delete'
  ])->where('id', '[0-9]+');

});

// Testing

Route::get('/tutor/markdown', function () {
    $res = Response::make('### Ini adalah Markdown');
    $res->headers->set('Content-Type', 'text/x-markdown');
    return $res;
});

Route::get('/tutor/{namaku}', function($namaku) {
    $data['nama'] = $namaku;
    return View::make('tutor.home', $data);
});
