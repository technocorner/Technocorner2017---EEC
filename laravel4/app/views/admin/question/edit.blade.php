@extends('admin.question.editable')

@section('form_open')
  {{ Form::open(['route' => array('admin.question.update', $question->id), 'class' => 'form-horizontal', 'files' => true]) }}
@stop

@section('field_qtype')
  {{ Form::select('qtype', $qtypes, $question->qtype->id, ['id' => 'qtype', 'class' => 'form-control', 'rows' => 1, 'required' => true]) }}
  {{ Form::text('qtype_new', '', ['id' => 'qtype-new', 'class' => 'form-control', 'rows' => 1, 'placeholder' => 'Buat tipe baru', 'required' => true]) }}
@stop

@section('field_question')
  {{ Form::textarea('question', $question->question, ['class' => 'form-control', 'rows' => 5, 'required' => true]) }}
@stop

@section('field_img')
  <img class="img-responsive" src="{{ $question->image }}" alt="question image" />
  {{ Form::file('image', []) }}
@stop

@section('field_chA')
  {{ Form::textarea('chA', $question->chA, ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chB')
  {{ Form::textarea('chB', $question->chB, ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chC')
  {{ Form::textarea('chC', $question->chC, ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chD')
  {{ Form::textarea('chD', $question->chD, ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_chE')
  {{ Form::textarea('chE', $question->chE, ['class' => 'form-control', 'rows' => 1, 'required' => true]) }}
@stop

@section('field_answerA')
  {{ Form::radio('answer', 'A', ($question->answer == 'A')? true : false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerB')
  {{ Form::radio('answer', 'B', ($question->answer == 'B')? true : false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerC')
  {{ Form::radio('answer', 'C', ($question->answer == 'C')? true : false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerD')
  {{ Form::radio('answer', 'D', ($question->answer == 'D')? true : false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_answerE')
  {{ Form::radio('answer', 'E', ($question->answer == 'E')? true : false, ['class' => 'col-sm-1', 'required' => true]) }}
@stop

@section('field_randomize')
  {{ Form::checkbox('randomize', 'rand', $question->randomize? true : false) }}
@stop
