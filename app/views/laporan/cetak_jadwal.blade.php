@extends('template.laporan')

@section('content')
  @include('laporan.senin')
  @include('laporan.selasa')
  @include('laporan.rabu')
  @include('laporan.kamis')
  @include('laporan.jumat')
  @include('laporan.sabtu')

@stop
