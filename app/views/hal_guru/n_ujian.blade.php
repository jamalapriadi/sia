@extends('template.index')

@section('content')
<legend>Nilai Harian</legend>

@if(Session::has('pesan'))
  {{Session::get('pesan')}}
@endif

<table class="table table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Rombel</th>
      <th></th>
      <th></th>
      <th>

      </th>
    </tr>
  </thead>
  <tbody>
    <?php $no=0;?>
    @foreach($jadwal as $row)
      <?php $no++;?>
      <tr>
        <td>{{$no}}</td>
        <td>{{$row->kd_rombel}}</td>
        <td>
          <a href="{{URL::to('guru/'.$row->kd_rombel.'/input_nilai_uts')}}" class="btn btn-success">
            Input Nilai UTS
          </a>
        </td>
          <td>
            <a href="{{URL::to('guru/'.$row->kd_rombel.'/input_nilai_uas')}}" class="btn btn-warning">
              Input Nilai UAS
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@stop
