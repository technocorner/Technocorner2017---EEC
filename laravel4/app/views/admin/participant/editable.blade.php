@extends('layout.master')

@section('head')
  <title>EEC - Daftarkan Peserta Baru</title>
@stop

@section('body')
  <main class="container-fluid">
    <h1>Manajemen Peserta</h1>
    <hr/>
	@yield('form_open', Form::open(array('route' => 'admin.participant.store', 'class' => 'form-horizontal form-daftar')))
    {{ Form::open(array('route' => 'admin.participant.store', 'class' => 'form-horizontal form-daftar')) }}
    <fieldset>
	  @yield('form_legend', '<legend>Peserta Baru</legend>')
      <div class="form-group">
        {{ Form::label('team_name', 'Nama Tim', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_teamname', Form::text('team_name', Input::old('team_name'), array('class' => 'form-control')))
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('email', 'Email', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_email', Form::email('email', Input::old('email'), array('class' => 'form-control', 'aria-describedby' => 'help-email')))
          <span id='help-email' class='help-block'>Email yang akan digunakan sebagai id login.</span>
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('password', 'Password', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_password', Form::text('password', '', array('class' => 'form-control')))
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('member_1', 'Anggota 1', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_member1', Form::text('member_1', Input::old('member_1'), array('class' => 'form-control')))
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('member_2', 'Anggota 2', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_member2', Form::text('member_2', Input::old('member_2'), array('class' => 'form-control')))
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('member_3', 'Anggota 3', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_member3', Form::text('member_3', Input::old('member_3'), array('class' => 'form-control')))
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('school', 'Asal Sekolah', array('class' => 'control-label col-sm-2')) }}
        <div class="col-sm-10">
		  @yield('form_school', Form::text('school', Input::old('school'), array('class' => 'form-control')))
          <span class='help-block'>Contoh format: SMA N 99 Yogyakarta</span>
        </div>
      </div>
    </fieldset>

	<hr/>
    {{ link_to_route('admin.participant.list', 'Kembali', null, ['class' => 'btn-dasar col-sm-offset-7 col-sm-2']) }}
	{{ Form::submit('Simpan', array('class' => 'btn btn-primary col-sm-offset-1 col-sm-2')) }}

    {{ Form::close() }}

	<div style="clear: both"></div>
	<hr/>
    <div class="paper-footer">
      <small>(c) Technocorner</small>
    </div>
  </main>
@stop
