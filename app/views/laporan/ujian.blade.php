@extends('template.index')

@section('content')
<legend>Laporan Nilai Ujian</legend>

@if(Session::has('pesan'))
{{Session::get('pesan')}}
@endif

{{Form::open(array('url'=>'admin/cetak_n_ujian','method'=>'GET','class'=>'form-horizontal'))}}

<div class="form-group">
  {{Form::label('Kelas','Kelas',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select name="kelas" class="form-control">
      <option></option>
      @foreach($kelas as $kel)
      <option value="{{$kel->kd_kelas}}">{{$kel->kd_kelas}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  {{Form::label('tahun','Tahun Ajaran',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select name="tahun" class="form-control">
      <option></option>
      @foreach($tahun as $tah)
      <option value="{{$tah->thn_ajaran}}">{{$tah->thn_ajaran}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  {{Form::label('mapel','Mata Pelajaran',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select name="mapel" class="form-control">
      <option></option>
      @foreach($mapel as $map)
      <option value="{{$map->kd_mapel}}">{{$map->kd_mapel}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  {{Form::label('semester','Semester',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select name="semester" class="form-control">
      <option></option>
      <option value='1'>1</option>
      <option value='2'>2</option>
    </select>
  </div>
</div>

<div class="form-group well">
  {{Form::label('','',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <button class="btn btn-primary">
      <i class="glyphicon glyphicon-print"></i>
      Cetak
    </button>
  </div>
</div>
{{Form::close()}}

<script>
  $(function(){
    $("#nis").autocomplete({
      source:"{{URL::to('admin/cari_siswa')}}", //alamat yang dituju
      minLength:2, //cari setelah 2 karakter
      select: function( event, ui ) {
        var nis=$("#nis").val();

        $.ajax({
          url:"{{URL::to('admin/get_siswa')}}",
          type:"POST",
          data:"nis="+nis,
          cache:false,
          success:function(msg){
            data=msg.split("|");
            $("#nama").val(data[0]);
            $("#jk").val(data[1]);
          }
        })
      }
    });

    $("#nis").result(function(even,data,formatted){});
  })
</script>
@stop
