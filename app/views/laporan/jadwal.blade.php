@extends('template.index')

@section('content')
  <legend>Laporan Jadwal</legend>

  {{Form::open(array('url'=>'admin/cetak_jadwal','method'=>'GET','class'=>'form-horizontal','target'=>'new target'))}}
  <div class="form-group">
    {{Form::label('tahun','Tahun Ajaran',array('class'=>'col-sm-2 control-label'))}}
    <div class="col-sm-4">
      <select name="tahun" class="form-control" required="required" id="tahun">
        <option></option>
        @foreach($rombel as $row)
          <option value="{{$row->thn_ajaran}}">{{$row->thn_ajaran}}</option>
        @endforeach
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
@stop
