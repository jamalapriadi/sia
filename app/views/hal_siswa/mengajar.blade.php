@extends('template.index')

@section('content')
<legend>Data Mengajar</legend>
<div class="form-horizontal">
  <div class="form-group">
    {{Form::label('nip','NIP Guru',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      <select name="nip" id="nip" class="form-control">
        <option></option>
        @foreach($guru as $row)
        <option valuew="{{$row->id}}">{{$row->id}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    {{Form::label('nip','Nama Guru',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      <input type="text" name="nama" id="nama" class="form-control" readonly="readonly">
    </div>
  </div>
</div>

<div id="tampil"></div>

<script>
$(function(){
  function mengajar(){
    var nip=$("#nip").val();

    $.ajax({
      url:"{{URL::to('siswa/get_mengajar')}}",
      type:"GET",
      data:"nip="+nip,
      cache:false,
      success:function(html){
        $("#tampil").html(html)
      }
    })
  }

  $("#nip").click(function(){
    var nip=$("#nip").val();

    $.ajax({
      url:"{{URL::to('siswa/get_guru')}}",
      type:"GET",
      data:"nip="+nip,
      cache:false,
      success:function(html){
        $("#nama").val(html);
        mengajar();
      }
    })
  })
})
</script>
@stop
