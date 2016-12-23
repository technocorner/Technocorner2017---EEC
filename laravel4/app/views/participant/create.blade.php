@extends('layout.master')

@section('head')
    <title>EEC - Daftar Peserta Baru</title>
@stop

@section('body')
<main class="container-fluid">
    <h1>Form Pendaftaran Peserta</h1>
    <hr/>
    {{ Form::open(array('route' => 'participant.store', 'class' => 'form-horizontal form-daftar')) }}
    <fieldset>

        <div class="form-group">
            {{ Form::label('team_name', 'Nama Tim', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('team_name', '', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('email', '', array('class' => 'form-control', 'aria-describedby' => 'help-email')) }}
                <span id='help-email' class='help-block'>Email yang akan digunakan sebagai id login.</span>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('konfirm_password', 'Konfirmasi Password', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::password('konfirm_password', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('member_1', 'Anggota 1', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('member_1', '', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('member_2', 'Anggota 2', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('member_2', '', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('member_3', 'Anggota 3', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('member_3', '', array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('school', 'Asal Sekolah', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-10">
                {{ Form::text('school', '', array('class' => 'form-control')) }}
                <span class='help-block'>Contoh format: SMA N 99 Yogyakarta</span>
            </div>
        </div>

        {{ Form::submit('Daftar', array('class' => 'btn btn-primary btn-lg col-sm-offset-2 col-sm-10')) }}

    </fieldset>
    {{ Form::close() }}
</main>
@stop

