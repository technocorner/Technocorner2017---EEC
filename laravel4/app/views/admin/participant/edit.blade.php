@extends('admin.participant.editable')

@section('form_open')
  {{ Form::open(array('route' => array('admin.participant.update', $participant->id), 'class' => 'form-horizontal form-daftar')) }}
@stop

@section('form_legend')
  <legend>Perbarui Data Peserta</legend>
@stop

@section('form_teamname')
  {{ Form::text('team_name', $participant->team_name, array('class' => 'form-control')) }}
@stop

@section('form_email')
  {{ Form::email('email', $participant->user->email, array('class' => 'form-control')) }}
@stop

@section('form_password')
  {{ Form::text('password', '', array('class' => 'form-control', 'placeholder' => 'Biarkan kosong untuk menggunakan password yang sama')) }}
@stop

@section('form_member1')
  {{ Form::text('member_1', $participant->member_1, array('class' => 'form-control')) }}
@stop

@section('form_member2')
  {{ Form::text('member_2', $participant->member_2, array('class' => 'form-control')) }}
@stop

@section('form_member3')
  {{ Form::text('member_3', $participant->member_3, array('class' => 'form-control')) }}
@stop

@section('form_school')
  {{ Form::text('school', $participant->school, array('class' => 'form-control')) }}
@stop
