<!--Rabu-->
<table class="table table-bordered table-striped">
  <thead>
    <tr class="success">
      <th colspan="{{$t+$d+$s+2}}">Rabu</th>
    </tr>

    <tr>
      <th rowspan='2'>Jam Ke</th>
      <th rowspan='2'>Hari</th>
      <th colspan="{{$t}}">Kelas 7</th>
      <th colspan="{{$d}}">Kelas 8</th>
      <th colspan="{{$s}}">Kelas 9</th>
    </tr>
    <tr>
      <?php
      $tujuh=DB::table('kelas')->where('kelas','7')->get();
      ?>
      @foreach($tujuh as $tj)
      <td>{{$tj->subkelas}}</td>
      @endforeach

      <?php
      $delapan=DB::table('kelas')->where('kelas','8')->get();
      ?>
      @foreach($delapan as $del)
      <td>{{$del->subkelas}}</td>
      @endforeach

      <?php
      $sem=DB::table('kelas')->where('kelas','9')->get();
      ?>
      @foreach($sem as $se)
      <td>{{$se->subkelas}}</td>
      @endforeach
    </tr>
  </thead>
  <tbody>
    <?php
    $jam2=Jam::all();?>
    @foreach($jam2 as $j)
    <tr>
      <td>{{$j->jam_ke}}</td>
      <td>{{$j->dari_jam.' - '.$j->sampai_jam}}</td>
      @foreach($tujuh as $tj)
      <?php
      $senin=DB::table('jadwal')->where('hari','Rabu')
      ->where('jam_ke',$j->jam_ke)
      ->where('kd_rombel',$tahun.'-'.$tj->kd_kelas);
      if($senin->count()>0){
        foreach($senin->get() as $sen){
          echo "<td>".$sen->kd_mapel."</td>";
        }
      }else{
        echo "<td>-</td>";
      }?>
      @endforeach

      @foreach($delapan as $del)
      <?php
      $senin=DB::table('jadwal')->where('hari','Rabu')
      ->where('jam_ke',$j->jam_ke)
      ->where('kd_rombel',$tahun.'-'.$del->kd_kelas);
      if($senin->count()>0){
        foreach($senin->get() as $sen){
          echo "<td>".$sen->kd_mapel."</td>";
        }
      }else{
        echo "<td>-</td>";
      }?>
      @endforeach

      @foreach($sem as $se)
      <?php
      $senin=DB::table('jadwal')->where('hari','Rabu')
      ->where('jam_ke',$j->jam_ke)
      ->where('kd_rombel',$tahun.'-'.$se->kd_kelas);
      if($senin->count()>0){
        foreach($senin->get() as $sen){
          echo "<td>".$sen->kd_mapel."</td>";
        }
      }else{
        echo "<td>-</td>";
      }?>
      @endforeach
    </tr>
    @endforeach
  </tbody>
</table>
