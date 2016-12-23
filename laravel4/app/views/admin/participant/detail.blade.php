@extends('layout.master')

@section('body')
  <main class="container-fluid">
    <h1>Detail Peserta</h1>
    {{ Form::open(['url' => '#', 'class' => 'form-horizontal']) }}
    <fieldset>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">ID</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->id }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Nama Tim</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->team_name }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Asal Sekolah</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->school }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Anggota 1</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->member_1 }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Anggota 2</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->member_2 }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Anggota 3</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->member_3 }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Email</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->user->email }}</p>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-sm-2">Password</label>
        <div class="col-sm-10">
          <p class="form-control-static">{{ $participant->user->password }}</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Exam</label>
        <div class="col-sm-10">
          @if (count($participant->exam))
          <pre class="form-control-static">{{ json_encode($participant->exam, JSON_PRETTY_PRINT)}}
          </pre>
          @else
            <p class="form-control-static">
              Belum memulai ujian
            </p>
          @endif
        </div>
      </div>
    </fieldset>
    {{ Form::close() }}

    {{ link_to_route('admin.viewAllParticipant', 'Kembali', null, ['class' => 'btn-dasar'])}}
    {{ link_to_route('admin.deleteExamParticipant', 'Reset Exam', $participant->id, ['class' => 'btn-dasar btn-important'])}}
  </main>
@stop
