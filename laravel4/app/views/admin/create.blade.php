@extends('layout.master')

@section('body')

  <main class="containter-fluid">
    <h1>Buat Admin Baru</h1>
    <hr/>
    {{ Form::open(['route' => 'admin.store', 'class' => 'form-horizontal form-daftar']) }}
    <fieldset>
      <legend>Data Admin Baru</legend>

      <div class="form-group">
        {{ Form::label('name', 'Nama', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::text('name', Input::old('name'), ['class' => 'form-control', 'placeholder' => 'Nama lengkap'])}}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('email', 'Email', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::text('email', Input::old('email'), ['class' => 'form-control', 'placeholder' => 'Email digunakan untuk login']) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('password', 'Password', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '********']) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('konfirm_password', 'Konfirmasi Password', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::password('konfirm_password', ['class' => 'form-control', 'placeholder' => '********']) }}
        </div>
      </div>

    </fieldset>
    <fieldset>
      <legend>Verifikasi Panitia Technocorner 2015</legend>

      <div class="form-group">
        {{ Form::label('secretOne', 'Nama panggilan ketua PH KMTETI periode 2013/2014 ', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::text('secretOne', null, ['class' => 'form-control', 'placeholder' => '********']) }}
        </div>
      </div>

      <div class="form-group">
        {{ Form::label('secretTwo', 'Nama event tahunan untuk mahasiswa baru JTETI', ['class' => 'control-label col-sm-2']) }}
        <div class="col-sm-10">
          {{ Form::text('secretTwo', null, ['class' => 'form-control', 'placeholder' => '********']) }}
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {{ link_to_route('admin.home', 'Kembali', null, ['class' => 'btn-dasar']) }}
          {{ Form::submit('Daftar', array('class' => 'btn-dasar btn-primary')) }}
        </div>
      </div>

    </fieldset>
    {{ Form::close() }}
    <hr/>
    <div class="paper-footer">
      <small>(c) Technocorner</small>
    </div>
  </main>

@stop
