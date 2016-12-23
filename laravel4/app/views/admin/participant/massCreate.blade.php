@extends('layout.master')

@section('head')
  <title>EEC - Daftarkan Peserta Baru</title>
@stop

@section('body')
  <main class="container-fluid">
    <h1>Manajemen Peserta</h1>
    <hr/>
    {{ Form::open(array('route' => 'admin.participant.massStore', 'class' => 'form-daftar')) }}
    <fieldset>
      <div class="form-group">
        {{ Form::label('team_name', 'Data', array('class' => 'control-label col-sm-2')) }}
        {{ Form::textArea('data', Input::old('data'), array('class' => 'form-control', "rows" => 5, "placeholder" => "copas CSV dari excel dengan format nama-tim;asal-sekolah;nama-ketua;email;password")) }}
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
