@extends('template.index')

@section('content')
  <legend>Nama Gallery : {{$album->nm_album}}</legend>
  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  {{Form::open(array('url'=>'admin/simpanfoto','method'=>'post','class'=>'form-horizontal','files'=>true))}}
  <div class="form-group">
    <div class="col-sm-4">
      <input type="hidden" name="album" value="{{$album->id_album}}">
      <input type="file" multiple="multiple" name="file[]" class="form-control">
    </div>
    <div class="col-sm-4">

      <button class="btn btn-primary">
        <i class="glyphicon glyphicon-upload"></i>
        Upload</button>
      </div>
    </div>
    {{Form::close()}}

    <div class="row">
      @foreach($detail as $row)
        <div class="col-sm-3">
          <div class="thumbnail">
            {{HTML::image('uploads/gallery/'.$row->foto,'',array('style'=>'width:200px;'))}}
            <div class="caption">
              <center>
                <a href="#" foto="{{$row->id_detail}}" class="btn btn-danger hapus">
                  <i class="glyphicon glyphicon-trash"></i>
                  Hapus
                </a>
              </center>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <script>
      $(function(){
        $(".hapus").click(function(){
          var foto=$(this).attr("foto");

          $.ajax({
            url:"{{URL::to('admin/hapusdetailfoto')}}",
            type:"POST",
            data:"foto="+foto,
            cache:false,
            success:function(html){
              location.reload();
            }
          })
        })
      })
    </script>
@stop
