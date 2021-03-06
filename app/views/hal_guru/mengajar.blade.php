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
            <option value="{{$row->id}}">{{$row->id}}</option>
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

  <div id="loading" style="display:none;">
    <div class="alert alert-info"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</div>
  </div>

  <div id="tampil"></div>

  <script>
    $(function(){
      function mengajar(){
        var nip=$("#nip").val();

        $.ajax({
          url:"{{URL::to('guru/get_mengajar')}}",
          type:"GET",
          data:"nip="+nip,
          cache:false,
          beforeSend:function(){
            $("#loading").show();
          },
          success:function(html){
            $("#loading").hide();
            $("#tampil").html(html)
          }
        })
      }

      $("#nip").click(function(){
        var nip=$("#nip").val();

        $.ajax({
          url:"{{URL::to('guru/get_guru')}}",
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
