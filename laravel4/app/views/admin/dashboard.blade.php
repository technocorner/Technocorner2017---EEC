@extends('layout.master')

@section('body')
  <main class="container-fluid">
    <h1>Dashboard Admin</h1>
    <hr/>
    <section class="dashboard">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#daftar-soal">Daftar Soal</a></li>
        <li><a href="{{ route('admin.participant.list') }}">Daftar Peserta</a></li>
      </ul>

      <h2>Daftar Soal</h2>
      <a href="{{ route('admin.question.create') }}" class="btn-dasar btn-primary">Tambah Soal</a>

      @if(Session::has('message'))
        @if(Session::get('message') == 'quest_add')
          <div class="bg-success">
            <span class="glyphicon glypichon-check"></span>
            <strong>Sukses</strong>: Soal berhasil ditambahkan ke DataBase.
          </div>
        @elseif(Session::get('message') == 'quest_update')
          <div class="bg-success">
            <span class="glyphicon glypichon-check"></span>
            <strong>Sukses</strong>: Soal berhasil diperbarui.
          </div>
        @elseif(Session::get('message') == 'quest_delete')
          <div class="bg-success">
            <span class="glyphicon glypichon-check"></span>
            <strong>Sukses</strong>: Soal berhasil dihapus.
          </div>
        @endif
      @endif

      <table class="table dashboard-table" id="daftar-soal">
        <tr>
          <th>ID</th>
          <th>Pertanyaan (cuplikan)</th>
          <th>Acak</th>
          <th>Gambar</th>
          <th>Mata Pelajaran</th>
          <th>Aksi</th>
        </tr>

        @foreach ($questions as $q)
		  @if ($q->qtype_id == 1)
			<tr>
              <td>{{ $q->id }}</td>
              <td>{{ substr($q->question, 0, 50)}}</td>
              <td><span class="glyphicon {{ $q->randomize ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td><span class="glyphicon {{ isset($q->image) ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td>{{ $q->qtype->name }}</td>
              <td class="dashboard-action">
				<a href="{{route('admin.question.detail', $q->id)}}"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a> |
				<a href="{{route('admin.question.edit', $q->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a> |
				<a href="{{route('admin.question.delete', $q->id)}}" class="need-confirmation"><span class="glyphicon glyphicon-trash"></span> HAPUS</a>
              </td>
			</tr>
		  @endif
        @endforeach

		<tr>
          <th>ID</th>
          <th>Pertanyaan (cuplikan)</th>
          <th>Acak</th>
          <th>Gambar</th>
          <th>Mata Pelajaran</th>
          <th>Aksi</th>
        </tr>

		@foreach ($questions as $q)
		  @if ($q->qtype_id == 2)
			<tr>
              <td>{{ $q->id }}</td>
              <td>{{ substr($q->question, 0, 50)}}</td>
              <td><span class="glyphicon {{ $q->randomize ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td><span class="glyphicon {{ isset($q->image) ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td>{{ $q->qtype->name }}</td>
              <td class="dashboard-action">
				<a href="{{route('admin.question.detail', $q->id)}}"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a> |
				<a href="{{route('admin.question.edit', $q->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a> |
				<a href="{{route('admin.question.delete', $q->id)}}" class="need-confirmation"><span class="glyphicon glyphicon-trash"></span> HAPUS</a>
              </td>
			</tr>
		  @endif
        @endforeach

		<tr>
		  <th>ID</th>
          <th>Pertanyaan (cuplikan)</th>
          <th>Acak</th>
          <th>Gambar</th>
          <th>Mata Pelajaran</th>
          <th>Aksi</th>
        </tr>

		@foreach ($questions as $q)
		  @if ($q->qtype_id == 3)
			<tr>
              <td>{{ $q->id }}</td>
              <td>{{ substr($q->question, 0, 50)}}</td>
              <td><span class="glyphicon {{ $q->randomize ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td><span class="glyphicon {{ isset($q->image) ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td>{{ $q->qtype->name }}</td>
              <td class="dashboard-action">
				<a href="{{route('admin.question.detail', $q->id)}}"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a> |
				<a href="{{route('admin.question.edit', $q->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a> |
				<a href="{{route('admin.question.delete', $q->id)}}" class="need-confirmation"><span class="glyphicon glyphicon-trash"></span> HAPUS</a>
              </td>
			</tr>
		  @endif
        @endforeach

		@foreach ($questions as $q)
		  <? $exist = 0 ?>
		  @if ($q->qtype_id != 1 && $q->qtype_id != 2 && $q->qtype_id != 3)
			@if ($exist == 1)
			  <tr>
				<th>ID</th>
				<th>Pertanyaan (cuplikan)</th>
				<th>Acak</th>
				<th>Gambar</th>
				<th>Mata Pelajaran</th>
				<th>Aksi</th>
			  </tr>
			@endif
			<? $exist++ ?>
			<tr>
              <td>{{ $q->id }}</td>
              <td>{{ substr($q->question, 0, 50)}}</td>
              <td><span class="glyphicon {{ $q->randomize ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td><span class="glyphicon {{ isset($q->image) ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></td>
              <td>{{ $q->qtype->name }}</td>
              <td class="dashboard-action">
				<a href="{{route('admin.question.detail', $q->id)}}"><span class="glyphicon glyphicon-eye-open"></span> Lihat</a> |
				<a href="{{route('admin.question.edit', $q->id)}}"><span class="glyphicon glyphicon-pencil"></span> Edit</a> |
				<a href="{{route('admin.question.delete', $q->id)}}" class="need-confirmation"><span class="glyphicon glyphicon-trash"></span> HAPUS</a>
              </td>
			</tr>
		  @endif
        @endforeach

      </table>

      <a href="{{ route('admin.question.create') }}" class="btn-dasar btn-primary">Tambah Soal</a>
    </section>
    <hr/>
    <div class="paper-footer">
      <small>(c) Technocorner</small>
    </div>
  </main>
@stop

@section('script')
@stop
