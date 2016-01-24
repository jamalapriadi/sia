@extends('template.laporan')

@section('content')
  <table class="table table-bordered">
    <thead>
      <tr>
        <th rowspan='2'>No.</th>
        <th rowspan='2'>NIP</th>
        <th rowspan='2'>Nama</th>
        <th rowspan='2'>Mapel</th>
        <th colspan='3'>Kelas</th>
        <th rowspan='2'>Jumlah Jam</th>
        <th  rowspan='2'>Keterangan</th>
      </tr>

      <tr>
        <th>7</th>
        <th>8</th>
        <th>9</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($mengajar as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->nip}}</td>
          <td>{{$row->nm_guru}}</td>
          <td>{{$row->kd_mapel}}</td>
          <td>
            <?php $kelas7=DB::table('jadwal')->where('id_guru',$row->id_guru)
            ->where('kd_rombel','like',$row->thn_ajaran."-7.%")->groupBy('id_guru')->get();?>
            @foreach($kelas7 as $kel7)
                v
            @endforeach
          </td>

          <td>
            <?php $kelas8=DB::table('jadwal')->where('id_guru',$row->id_guru)
            ->where('kd_rombel','like',$row->thn_ajaran."-8.%")->groupBy('id_guru')->get();?>
          @foreach($kelas8 as $kel8)
            v
          @endforeach
          </td>

          <td>
            <?php $kelas9=DB::table('jadwal')->where('id_guru',$row->id_guru)
            ->where('kd_rombel','like',$row->thn_ajaran."-9.%")->groupBy('id_guru')->get();?>
          @foreach($kelas9 as $kel9)
            v
          @endforeach
        </td>
          <td>
            <?php
            //select count(*) from jadwal where id_mengajar like '%196210221984122001%'
            $jum=DB::select("select count(*) as jumlah from jadwal where id_guru='$row->id_guru'")?>
            @foreach($jum as $j)
              {{$j->jumlah}}
            @endforeach
          </td>
          <td></td>

        </tr>
      @endforeach
    </tbody>
  </table>
@stop
