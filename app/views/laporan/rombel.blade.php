@extends('template.index')

@section('content')
  <legend>Laporan Rombel</legend>

  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'admin/cetak_rombel','method'=>'GET','class'=>'form-horizontal','target'=>'new target'))}}
    <div class="form-group">
      {{Form::label('kelas','Kelas',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <select name="kelas" class="form-control" required="required" id="kelas">
          <option></option>
          @foreach($kelas as $kelas)
            <option value="{{$kelas->kd_kelas}}">{{$kelas->kd_kelas}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      {{Form::label('tahun','Tahun Ajaran',array('class'=>'col-sm-2 control-label'))}}
      <div class="col-sm-4">
        <select name="tahun" class="form-control" required="required" id="tahun">
          <option></option>
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
          url:"{{URL::to('admin/lap_get_tahun')}}",
          type:"GET",
          data:"kelas="+kelas,
          cache:false,
          success:function(html){
            $("#tahun").html(html);
          }
        })
      })
    })
  </script>
@stop
