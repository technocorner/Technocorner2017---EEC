<?php

class ParticipantController extends BaseController {

    public function dashboard()
    {
      $p = Auth::user()->userable;

      return View::make('participant.dashboard')
        ->withParticipant($p);
    }

    public function create()
    {
        return View::make('participant.create');
    }

    public function store()
    {
      $p            = new Participant;
      $p->team_name = Input::get('team_name');
      $p->member_1  = Input::get('member_1');
      $p->member_2  = Input::get('member_2');
      $p->member_3  = Input::get('member_3');
      $p->school    = Input::get('school');
      $p->save();

      $u            = new User;
      $u->email     = Input::get('email');
      $u->password  = Hash::make(Input::get('password'));
      $u->save();

      // Polymorph magic
      $p->user()->save($u);

      // Setelah user daftar maka dia akan otomatis login  dan dikirim ke halaman dashboardnya
      Auth::login($u);

      return Redirect::route('participant.dashboard');
    }

    public function index()
    {
      $participant = Participant::all();

      return View::make('participant.index')
        ->withParticipant($participant);
    }

    public function login()
    {
      if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
        return Redirect::intended(route('participant.dashboard'));
      }

      return Redirect::route('home')
        ->withMessage('login_fail');
    }

    public function logout()
    {
      Auth::logout();
      return Redirect::route('home')
        ->withMessage('logout_participant');
    }
}