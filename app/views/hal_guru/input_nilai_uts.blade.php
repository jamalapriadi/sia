@extends('template.index')

@section('content')
<legend>Input Nilai UTS</legend>
@if(Session::has('pesan'))
{{Session::get('pesan')}}
@endif

{{Form::open(array('url'=>'guru/simpan_uts','method'=>'post','class'=>'form-horizontal'))}}

<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered">
      <tr>
        <td>Kelas</td>
        <input type="hidden" id="rombel" name="rombel" value="{{$kelas->kd_rombel}}">
        <input type="hidden" name="rombel" value="{{$kelas->kd_rombel}}">
        <td> : {{$kelas->kd_kelas}}</td>
      </tr>
      <tr>
        <td>Tahun Ajaran</td>
        <td> : {{$kelas->thn_ajaran}}</td>
      </tr>
      <tr>
        <td>NIP / Nama Wali</td>
        <td> : {{$kelas->guru->nm_guru}}</td>
      </tr>
    </table>
  </div>
  <div class="col-sm-6">

    </div>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>NIS</th>
        <th>Nama</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($siswa as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->nis}}
          <input type="hidden" name="nis{{$no}}" value="{{$row->nis}}">
        </td>
        <td>{{$row->nm_siswa}}</td>
        <td>
          <input type="number" style="width:40%" min="1" max="10" value="{{isset($row->n_uts)?$row->n_uts:''}}" name="nilai{{$no}}" class="form-control" required="required">
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="well">
    <button class="btn btn-primary">
      <i class="glyphicon glyphicon-saved"></i>
      Simpan
    </button>
  </div>

  {{Form::close()}}

  <script>
    $(function(){
      $("#semester").click(function(){
        $("#jenis").val('');
      });
    });
  </script>
@stop
