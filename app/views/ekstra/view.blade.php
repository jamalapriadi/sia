@extends('template.index')
@section('content')
  <legend>Nama Ektstra : {{$ekstra->nm_ekstra}}</legend>

  <p>Pengampu : {{$ekstra->nip}}</p>

  <p>
    {{HTML::image('uploads/ekstra/'.$ekstra->logo_ekstra,'',array('style'=>'width:100px;float:left;'))}}
    {{$ekstra->keterangan}}
  </p>
@stop
