@extends('template.index')

@section('content')
<legend>Data Rombel</legend>
<div class="form-horizontal">
  <div class="form-group">
    {{Form::label('Rombel','Rombel',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      <select name="rombel" id="rombel" class="form-control">
        <option></option>
        @foreach($rombel as $row)
        <option value="{{$row->kd_rombel}}">{{$row->kd_rombel}}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div id="loading" style="display:none;">
  <div class="alert alert-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</div>
</div>

<div id="tampil"></div>

<script>
$(function(){
  $("#rombel").click(function(){
    var rombel=$("#rombel").val();

    $.ajax({
      url:"{{URL::to('siswa/get_rombel')}}",
      type:"GET",
      data:"rombel="+rombel,
      cache:false,
      beforeSend:function(){
        $("#loading").show();
      },
      success:function(html){
        $("#loading").hide();
        $("#tampil").html(html);
      }
    });
  });
});
</script>
@stop
