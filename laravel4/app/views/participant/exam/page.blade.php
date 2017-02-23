@extends('layout.master')

@section('body')

  <main class="container-fluid">
    <h1>
      BABAK PENYISIHAN EEC 2017 <br>
      <small>Mata pelajaran {{ ucwords((Input::get('mapel')? Input::get('mapel') : 'matematika')) }}</small>
    </h1>
    <hr/>

      <a href="" class="btn btn-primary" id="simpan">Simpan Jawaban Sementara</a>
      <button class="btn btn-info" data-toggle="popover" data-placement="right" title="Simpan Jawaban Sementara" id="tanya"
      data-content="Tombol 'Simpan Jawaban Sementara' digunakan untuk meng-update jawaban ke server, bukan untuk mengakhiri ujian.">?</button>
      <button type="button" class="btn btn-info-2 right" data-toggle="modal" data-target="#petunjukumum">
        Petunjuk Umum Seleksi Online EEC
      </button>

    <hr/>

      {{ Form::open([
        'route' => 'participant.exam.showConfirmFinish',
        'class' => 'exam-paper',
  		  'id' => (Input::has('mapel')? Input::get('mapel') : 'matematika') . '-paper',
        'data-subjectId' => $subject_id
      ]) }}

      {{ Form::hidden('exam_id', $exam_id, ['id' => 'exam_id']) }}

      <?php $no = 1 ?>
      <div class="content-kanan">
        <ul class="nav nav-tabs" role="tablist">
        @foreach ($questions as $q)
          <li><a class="tab-size" href="#{{ $no }}" role="tab" data-toggle="tab">{{ $no++ }}</a></li>
        @endforeach
        </ul>
      </div>

      <?php $no = 1 ?>
      {{-- Get all the question and chunk it in group of 5 #explaining what code already does, what a bad comment --}}
      {{-- So we can make <hr> separator every 5 question --}}
      {{-- @foreach (array_chunk($questions->all(), 5) as $question_group) --}}
      <div class="content-kiri">
       <div class="tab-content">
        @foreach ($questions as $q)
        <div class="tab-pane" id="{{ $no }}">
          <div class="row question" id="{{ $q->id }}">
            <div class="col-sm-1" style="text-align:right"> {{-- BEWARE: inline styles --}}
              <label>{{ $no++ }}.</label>
            </div>

            <div class="col-sm-11">
              <p>
                {{ $q->getQuestion() }}
              </p>

      			  @if ($q->image)
              <div class="question-image">
                <img src="{{ $q->image }}" alt="Pertanyaan untuk soal {{ $q->id }}">
              </div>
      			  @endif

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', 'A', Input::old( $q->id . '-ch'), ['class' => 'choice-radio']) }}
                  <strong>A.</strong> {{ $q->getChoice('A') }}
                </label>
              </div>

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', 'B', Input::old( $q->id . '-ch'), ['class' => 'choice-radio'] ) }}
                  <strong>B.</strong> {{ $q->getChoice('B') }}
                </label>
              </div>

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', 'C', Input::old( $q->id . '-ch'), ['class' => 'choice-radio'] ) }}
                  <strong>C.</strong> {{ $q->getChoice('C') }}
                </label>
              </div>

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', 'D', Input::old( $q->id . '-ch'), ['class' => 'choice-radio'] ) }}
                  <strong>D.</strong> {{ $q->getChoice('D') }}
                </label>
              </div>

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', 'E', Input::old( $q->id . '-ch'), ['class' => 'choice-radio'] ) }}
                  <strong>E.</strong> {{ $q->getChoice('E') }}
                </label>
              </div>

              <div class="radio">
                <label>
                  {{ Form::radio( $q->id . '-ch', '', Input::old( $q->id . '-ch'), ['class' => 'choice-radio'] ) }}
                  <strong>Kosongkan</strong>
                </label>
              </div>
            </div>
          </div>
        </div>
        @endforeach
       </div>
      </div>

      <div class="row">
        <div class="col-sm-offset-1 col-sm-10">
          <nav class="paging" style="text-align: center">
            <div class="pagination pagination-lg">
              @foreach ($subject_list as $subject)
                <li {{ (Input::get('mapel')? Input::get('mapel') : 'matematika') == strtolower($subject) ? 'class="active"' : null }}>
                  {{ link_to_route('participant.exam.page', $subject, ['mapel' => strtolower($subject)], ['class' => 'subject-link']) }}
                </li>
              @endforeach
            </div>
          </nav>
        </div>
      </div>

      {{ Form::submit('Selesai', ['class' => 'col-sm-offset-4 col-sm-4 btn btn-primary', 'id' => 'submit-answer'])}}

      {{ Form::close() }}
      <button class="btn btn-info" data-toggle="popover" data-placement="right" title="Tombol Selesai" id="tanya"
      data-content="Tombol 'Selesai' hanya boleh ditekan oleh salah satu peserta dalam tim, karena akan mengakhiri pengerjaan ujian.">?</button>

      <!-- Modal petunjukumum -->
      <div class="modal fade" id="petunjukumum" tabindex="-1" role=petunjukumum"dialogpetunjukumum" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tombol "Selesai"</h4>
            </div>
            <div class="modal-body">
              <ul>
          	  <li>Soal terdiri dari 120 nomor soal pilihan ganda dengan 45 nomor soal matematika, 40 nomor soal fisika dan 35 nomor soal komputer.</li>
              <li>
                <strong>Satu akun</strong> yang diberikan oleh panitia dapat digunakan <strong>login pada 3 PC/Laptop</strong>, dengan demikian setiap anggota Tim dapat login pada PC/Laptop yang berbeda dan <strong>mengerjakan mata pelajaran berbeda</strong>.
                <br>
                <img src="https://technocornerugm.com/images/contoh.jpg" class="img-contoh" alt="">
              </li>
              <li>Peserta dapat menyimpan jawaban sementara ke server dengan cara <strong>berpindah mata pelajaran</strong> dan dengan cara klik tombol <strong>"Simpan Jawaban Sementara"</strong> pada halaman ujian. Contoh, setelah menjawab beberapa soal di matematika dan berpindah ke soal komputer, maka jawaban soal matematika akan otomatis tersimpan ke server.</li>
              <li>Bacalah dengan cermat setiap soal dan pilihlah jawaban yang menurut Anda benar.</li>
          	  <li>Ujian ini bersifat buku terbuka dan Anda diperkenankan menggunakan alat hitung.</li>
          	  <li>Anda tidak diperkenankan untuk berdiskusi selain dengan sesama anggota tim sendiri.</li>
          	  <li>Waktu ujian yang disediakan adalah 120 menit terhitung setelah tombol “MULAI UJIAN” ditekan.</li>
          	  <li>Anda diberikan toleransi waktu untuk login (termasuk menekan tombol “MULAI UJIAN”) selama 30 menit (pukul 09.00 – 09.30 WIB). Setelah pukul 09.30 WIB, waktu ujian akan otomatis berjalan sehingga ujian berakhir selambat lambatnya pukul 11.30 WIB.</li>
          	  <li>Jawaban yang benar akan diberi skor +4, jawaban yang kosong diberi skor 0, dan jawaban yang salah diberi skor -1.</li>
          	  <li>Salin jawaban Anda ke secarik kertas untuk mengantisipasi hal-hal yang tidak dikehendaki.</li>
              </ul>

              <br><br>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <div style="clear: both"></div>
	  <hr/>
      <div class="paper-footer col-sm-12">
    		<small>(c) Technocorner</small>
      </div>
  </main>




@stop

@section('script')
  <script src="/script/exam.js"></script>
@stop
