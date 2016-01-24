@extends('template.index')

@section('content')
<legend>Jadwal Mengajar</legend>

<div class="form-horizontal well">
  <div class="form-group">
    {{Form::label('kelas','Rombel',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-3">
      <select name="rombel" id="rombel" class="form-control">
        <option></option>
        @foreach($rombel as $row)
        <option value="{{$row->kd_rombel}}">{{$row->kd_rombel}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-sm-3">
      <a href="#" class="btn btn-primary" id="cetak">
        <i class="glyphicon glyphicon-print"></i>
        Cetak
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div id="pesan"></div>
</div>

<script>
$(function(){
  $("#rombel").click(function(){
    var rombel=$("#rombel").val();

    if(rombel==""){
      $("#pesan").html("<div class='alert alert-danger'>Data Rombel yang anda pilih kosong</div>");
    }else{
      $.ajax({
        url:"{{URL::to('guru/tampil_jadwal')}}",
        type:"GET",
        data:"rombel="+rombel,
        cache:false,
        success:function(html){
          $("#pesan").html(html);
        }
      });
    }
  });
});
</script>
@stop
