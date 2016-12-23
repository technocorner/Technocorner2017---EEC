
@extends('layout.master')

@section('body')
  <main class="container-fluid">
    <h1>Detail Soal</h1>
    <hr/>
    <form class="form-horizontal">
      <fieldset>
        <div class="form-group">
          {{ Form::label('id', 'ID Soal', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->id }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('qtype', 'Tipe Soal', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->qtype->name }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('question', 'Pertanyaan', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->getQuestion() }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('image', 'Gambar', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            @if(isset($question->image))
			  <div class="form-control-static col-sm-10">
                <img src="{{ $question->image }}" alt="Gambar soal" class="img-responsive">
			  </div>
            @else
              Tidak ada gambar.
            @endif
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('chA', 'Pilihan A', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->chA }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('chB', 'Pilihan B', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->chB }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('chC', 'Pilihan C', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->chC }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('chD', 'Pilihan D', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->chD }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('chE', 'Pilihan E', ['class' => 'control-label col-sm-2']) }}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->chE }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('answer', 'Kunci Jawaban', ['class' => 'control-label col-sm-2'])}}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->answer }}</p>
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('randomize', 'Acak/Tetap', ['class' => 'control-label col-sm-2'])}}
          <div class="col-sm-10">
            <p class="form-control-static">{{ $question->randomize? "Acak" : "Tetap" }}</p>
          </div>
        </div>

        <hr/>
        {{ link_to_route('admin.dashboard', 'Kembali', null, ['class' => 'btn-dasar col-sm-offset-2']) }}
        {{ link_to_route('admin.question.create', 'Tambah Soal Baru', ['qtype' => $question->qtype->name], ['class' => 'btn-dasar']) }}
        {{ link_to_route('admin.question.edit', 'Edit Soal', ['id' => $question->id], ['class' => 'btn-dasar btn-primary']) }}
      </fieldset>
    </form>
  </main>
@stop
