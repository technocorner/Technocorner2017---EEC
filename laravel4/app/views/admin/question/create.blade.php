@extends('admin.question.editable')

@section('form_open')
  {{ Form::open(['route' => 'admin.question.store', 'class' => 'form-horizontal', 'files' => true]) }}
@stop

@section('field_qtype')
  {{ Form::select('qtype', $qtypes, Input::has('qtype')? array_search(Input::get('qtype'), $qtypes) : Input::old('qtype'), ['id' => 'qtype', 'class' => 'form-control', 'rows' => 1, 'required' => true]) }}
  {{ Form::text('qtype_new', Input::old('qtype_new'), ['id' => 'qtype-new', 'class' => 'form-control', 'rows' => 1, 'placeholder' => 'Buat tipe baru', 'required' => true]) }}
@stop

@section('field_question')
  {{ Form::textarea('question', Input::old('question'), ['class' => 'form-control', 'rows' => 5, 'required' => true]) }}
@stop

@section('field_img')
  {{ Form::file('image', Input::old('image'), ['class' => 'form-control', 'required' => true]) }}
@stop

@section('field_chA')
  {{ Form::textarea('chA', Input::old('chA'), ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chB')
  {{ Form::textarea('chB', Input::old('chB'), ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chC')
  {{ Form::textarea('chC', Input::old('chC'), ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chD')
  {{ Form::textarea('chD', Input::old('chD'), ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chE')
  {{ Form::textarea('chE', Input::old('chE'), ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_answerA')
  {{ Form::radio('answer', 'A', false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerB')
  {{ Form::radio('answer', 'B', false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerC')
  {{ Form::radio('answer', 'C', false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerD')
  {{ Form::radio('answer', 'D', false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerE')
  {{ Form::radio('answer', 'E', false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_randomize')
  {{ Form::checkbox('randomize', Input::old('randomize'), true) }}
@stop
