@extends('layout.master')

@section('body')
  <main class="container-fluid">
    <h1>Buat Soal Baru</h1>
    <hr/>
    @yield('form_open', Form::open(['route' => 'admin.question.store', 'class' => 'form-horizontal', 'files' => true]))
    <fieldset>
      <div class="form-group">
        <div class="col-sm-2">
          {{ Form::label('qtype', 'Tipe Soal', ['class' => 'control-label col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_qtype', Form::text('qtype', Input::old('qtype'), ['class' => 'form-control', 'rows' => 5, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          {{ Form::label('question', 'Pertanyaan', ['class' => 'control-label col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_question', Form::textarea('question', Input::old('question'), ['class' => 'form-control', 'rows' => 5, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          {{ Form::label('image', 'Gambar', ['class' => 'control-label col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_img', Form::file('image', Input::old('image'), ['class' => 'form-control', 'required' => true]))
        </div>
      </div>

      <div class="form-group control-row">
        <div class="col-sm-2">
          @yield('field_answerA', Form::radio('answer', 'A', ['required' => true]))
          {{ Form::label('chA', 'Pilihan A', ['class' => 'col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_chA', Form::textarea('chA', Input::old('chA'), ['class' => 'form-control', 'rows' => 1, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          @yield('field_answerB', Form::radio('answer', 'B', ['required' => true]))
          {{ Form::label('chB', 'Pilihan B', ['class' => 'col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_chB', Form::textarea('chB', Input::old('chB'), ['class' => 'form-control', 'rows' => 1, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          @yield('field_answerC', Form::radio('answer', 'C', ['required' => true]))
          {{ Form::label('chC', 'Pilihan C', ['class' => 'col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_chC', Form::textarea('chC', Input::old('chC'), ['class' => 'form-control', 'rows' => 1, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          @yield('field_answerD', Form::radio('answer', 'D', ['required' => true]))
          {{ Form::label('chD', 'Pilihan D', ['class' => 'col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_chD', Form::textarea('chD', Input::old('chD'), ['class' => 'form-control', 'rows' => 1, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          @yield('field_answerE', Form::radio('answer', 'E', ['required' => true]))
          {{ Form::label('chE', 'Pilihan E', ['class' => 'col-sm-10']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_chE', Form::textarea('chE', Input::old('chE'), ['class' => 'form-control', 'rows' => 1, 'required' => true]))
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          {{ Form::label('randomize', 'Acak', ['class' => 'col-sm-10 control-label']) }}
        </div>
        <div class="col-sm-10">
          @yield('field_randomize', Form::checkbox('randomize', Input::old('randomize')))
        </div>
      </div>

      <hr/>
      <div class="col-sm-offset-6 col-sm-6">
        {{ link_to_route('admin.dashboard', 'Kembali', null, ['class' => 'btn-dasar col-sm-5']) }}
        {{ Form::submit('Simpan', ['class' => 'btn-dasar btn-primary col-sm-offset-1 col-sm-6']) }}
      </div>
    </fieldset>
    {{ Form::close() }}

	<hr/>
    <div class="paper-footer">
      <small>(c) Technocorner</small>
    </div>
  </main>
@stop

@section('script')
  <script src="/script/admin.question.editable.min.js"></script>
@stop
