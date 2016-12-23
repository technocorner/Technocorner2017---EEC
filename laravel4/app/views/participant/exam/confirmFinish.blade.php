@extends('layout.master')

@section('body')

  <main class="container-fluid">
    <h1>Apakah kamu yakin ingin menyelesaikan ujian?</h1>
    @if($exam->session == 2)
      <h2>Waktu Ujian Anda sudah habis!</h2>
      <p>Tombol 'kembali' tidak akan bisa digunakan, Anda harus menyelesaikan ujian agar dapat kami rekap.</p>
    @endif
    {{ Form::open(['route' => 'participant.exam.confirmFinish']) }}

    {{ Form::submit('Ya, saya sangat yakin.') }}
    {{ link_to_route('participant.exam.page', 'Tidak, saya masih ingin mengerjakan ujian!') }}

    {{ Form::close() }}
  </main>

@stop