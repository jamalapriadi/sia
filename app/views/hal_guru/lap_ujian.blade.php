@extends('template.index')

@section('content')
<legend>Laporan Nilai Ujian</legend>

@if(Session::has('pesan'))
{{Session::get('pesan')}}
@endif

{{Form::open(array('url'=>'guru/cetak_n_ujian','method'=>'GET','class'=>'form-horizontal'))}}

<div class="form-group">
  {{Form::label('Kelas','Kelas',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select name="kelas" class="form-control" id="kelas">
      <option></option>
      @foreach($kelas as $kel)
      <option value="{{$kel->kd_rombel}}">{{$kel->kd_rombel}}</option>
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
    $("#kelas").click(function(){
      var kelas=$("#kelas").val();

      $.ajax({
        url:"{{URL::to('guru/cari_mapel')}}",
        type:"GET",
        data:"kelas="+kelas,
        cache:false,
        success:function(html){
          $("#mapel").html(html)
        }
      })
    })
  });
</script>
@stop
