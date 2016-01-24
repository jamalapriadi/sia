@extends('template.index')

@section('content')
  <legend>Nilai Ujian</legend>

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
            <a href="{{URL::to('guru/'.$row->kd_rombel.'/lihat_nilai_harian')}}" class="btn btn-success">
              Lihat Nilai
            </a>
          </td>
          <td>
            <a href="{{URL::to('guru/'.$row->kd_rombel.'/history_nilai_harian')}}" class="btn btn-primary">
              History Nilai
            </a>
          </td>
          <td>
            <a href="{{URL::to('guru/'.$row->kd_rombel.'/input_nilai_harian')}}" class="btn btn-warning">
              Input Nilai
            </a>
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
@stop
