@extends('template.index')

@section('content')
<style>
.kotak{
  background: lightgreen;
  border-left: 10px solid red;
  padding: 5px;
}
.thumbnail:hover{
  background: lightblue;
}
</style>
<legend></legend>

<div class="kotak">
  <h4>Selamat Datang</h4>
  <p>Hai <strong>{{Sentry::getUser()->username}}</strong>, selamat datang di halaman SIAKAD,</p>
  <p>Silahkan klik menu pilihan yang berada di bawah ini untuk data yang diinginkan</p>
</div>
<br>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <p>Menu</p>
      </div>
      <div class="panel-body">
        <div class="row">

          <div class="col-md-3">
            <div class="thumbnail">
              <a href="{{URL::to('siswa/mengajar')}}">
                <img src="{{URL::to('assets/img/guru.png')}}" style="max-height:100px;">
              </a>
            </div>
          </div>

          <div class="col-md-3">
            <div class="thumbnail">
              <a href="{{URL::to('siswa/rombel')}}">
                <img src="{{URL::to('assets/img/rombel.png')}}" style="max-height:100px;">
              </a>
            </div>
          </div>

          <div class="col-md-3">
            <div class="thumbnail">
              <a href="{{URL::to('siswa/lap_nilai')}}">
                <img src="{{URL::to('assets/img/laporan.png')}}" style="max-height:100px;">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <p>Jadwal Pelajaran Tahun</p>
      </div>
      <div class="panel-body">

      </div>
    </div>
  </div>
</div>


@stop
