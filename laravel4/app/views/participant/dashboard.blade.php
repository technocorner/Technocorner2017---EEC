@extends('layout.master')

@section('head')
  <title>Technocorner 2017 - Dashboard Peserta</title>
@stop

@section('body')
  <main class="container-fluid">
    <h1>Selamat Datang Peserta EEC 2017</h1>
    <hr/>
    <section class="dashboard">
      <h2>Detail Tim Kamu</h2>
      {{ Form::open(['url' => '#', 'class' => 'form-horizontal']) }}
      <fieldset>
        <legend> {{ $participant->team_name }}</legend>
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
          <label for="" class="control-label col-sm-2">Ketua</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $participant->member_1 }}</p>
          </div>
        </div>
        @if($participant->member_2 != "")
            <div class="form-group">
                <label for="" class="control-label col-sm-2">Anggota 2</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $participant->member_2 }}</p>
                </div>
            </div>
        @endif
        @if($participant->member_3 != "")
            <div class="form-group">
                <label for="" class="control-label col-sm-2">Anggota 3</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $participant->member_3 }}</p>
                </div>
            </div>
        @endif
        <div class="form-group">
          <label for="" class="control-label col-sm-2">Email</label>
          <div class="col-sm-10">
            <p class="form-control-static">{{ $participant->user->email }}</p>
          </div>
        </div>
      </fieldset>
      {{ Form::close() }}

      <hr>
      <a href="{{ route('participant.exam.preparation') }}" class="btn-dasar btn-important" >
        <?php
        $x = isset($participant->exam->session) ? $participant->exam->session : 0;
        switch ($x) {
          case 0:
            echo "Bersiap Ujian";
            break;
          case 1:
            echo "Lanjutkan Ujian";
            break;
          case 2:
          case 3:
            echo "Lihat Hasil";
            break;
          default:
            echo "Error!";
        }
        ?>
      </a>
      <hr>

      @if( App::environment() == 'local' )
        <h1>DEVELOP MODE ONLY</h1>
        <h2>Cek Time <small>Pastikan waktu server = waktu lokal</small></h2>
        {{ Carbon::now() }}
        <h2>Exam Model Data</h2>

        <p>
        ID : {{ count($participant->exam) ? $participant->exam->id : 'User belum punya model Exam' }} <br>
        @if (count($participant->exam))
          Here, just read the JSON yourself. <br>
          <pre>{{ json_encode($participant->exam, JSON_PRETTY_PRINT) }}</pre>
        @endif

        </p>

        <a href="{{ route('participant.exam.destroy') }}" class="btn-dasar disabled">DEVELOP ONLY: destroy user Exam</a>
        <hr>
      @endif

      <h2>Petunjuk Web (Mohon dipahami agar tidak terjadi hal yang tidak diinginkan)</h2>
      <ul>
        <li>Pastikan detail nama tim dan nama ketua tim sudah benar.</li>
        <li>Jika terdapat kesalahan pada detail tim kamu, segera laporkan ke admin Technocorner di <strong>technocorner@mail.ugm.ac.id</strong> atau melalui nomor yang tertera pada bagian bawah halaman</li>
        <li>Setiap akun hanya boleh digunakan untuk maksimal 3 PC/Laptop.</li>
        <li>
          <strong>Satu akun</strong> yang diberikan oleh panitia dapat digunakan <strong>login pada 3 PC/Laptop</strong>, dengan demikian setiap anggota Tim dapat login pada PC/Laptop yang berbeda dan <strong>mengerjakan mata pelajaran berbeda</strong>.
          <br>
          <img src="https://technocornerugm.com/images/contoh.jpg" class="img-contoh" alt="">
        </li>
        <li>Sangat disarankan untuk melakukan Ujian Online dengan menggunakan <strong>desktop/PC dan browser modern</strong> (IE versi 10 ke atas, Google Chrome, Chromium, atau Firefox)</li>
        <li>Peserta dapat menyimpan jawaban sementara ke server dengan cara <strong>berpindah mata pelajaran</strong> dan dengan cara klik tombol <strong>"Simpan Jawaban Sementara"</strong> pada halaman ujian. Contoh, setelah menjawab beberapa soal di matematika dan berpindah ke soal komputer, maka jawaban soal matematika akan otomatis tersimpan ke server.</li>
        <li>Setiap tim diberikan toleransi waktu untuk login (termasuk menekan tombol <strong>"MULAI UJIAN"</strong> selama 30 menit (pukul 09.00-09.30 WIB). Setelah lewat pukul 09.30 WIB, peserta tidak dapat masuk ke menu ujian dan peserta dinyatakan diskualifikasi.</li>
        <li>Pastikan koneksi internet anda stabil, terutama saat meng-klik tombol <strong>"MULAI UJIAN"</strong>.</li>
        <li>Refresh pada page ujian tidak mempengaruhi timer, timer tetap berjalan semestinya.</li>
        <li>Web seleksi Online EEC tidak menyediakan fitur print.</li>
        <li>Script soal pada web tidak dapat di-block atau di-copy.</li>
        <li>Setiap tim dapat logout dan login selama proses pengerjaan soal berlangsung, akan tetapi timer tetap berjalan semestinya.</li>
        <li>Jika waktu pengerjaan telah selesai, secara otomatis ujian akan berakhir dan jawaban terakhir peserta akan tersimpan.</li>
        <li>Jika  Anda sudah menekan tombol “selesai”, Anda tidak dapat mengulangi ujian ataupun mengganti jawaban.</li>
      </ul>

      <h2>Petunjuk Melakukan Ujian</h2>
      <ul>
        <li>Login pada waktu yang ditentukan oleh panitia (sesuai jadwal).</li>
        <li>Periksa data diri.</li>
        <li>Jika telah siap tekan tombol "Bersiap Ujian"</li>
        <li>Baca dan pahami peraturan pada halaman Persiapan Ujian dengan seksama.</li>
        <li>Berdo'a sebelum memulai ujian.</li>
        <li>Jika telah siap, tekan tombol "Mulai Ujian".</li>
        <li>Baca soal dengan seksama dan pilih jawaban yang paling tepat dengan menekan salah satu jawaban.</li>
        <li>Jika telah selesai, tekan tombol "Selesai".</li>
      </ul>
    </section>
    <hr/>
    <div class="paper-footer">
      <small>(c) Technocorner</small>
    </div>
  </main>
@stop
