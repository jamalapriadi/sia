@extends('template.index')

@section('content')
<legend>Laporan Nilai Raport</legend>

{{Form::open(array('url'=>'siswa/cetak_raport','method'=>'GET','class'=>'form-horizontal'))}}
<div class="form-group">
  {{Form::label('Rombel','Rombel',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select required="required" name="rombel" class="form-control" id="rombel">
      <option></option>
      @foreach($rombel as $row)
      <option value="{{$row->kd_rombel}}">{{$row->kd_rombel}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  {{Form::label('semester','Semester',array('class'=>'col-sm-2 control-label'))}}
  <div class="col-sm-4">
    <select required="required" name="semester" class="form-control" id="rombel">
      <option></option>
      <option value="1">1</option>
      <option value="2">2</option>
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
