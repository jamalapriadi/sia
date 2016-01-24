<div>
  <table class="table table-bordered">
    <tr>
      <td>Kelas</td>
      <td> : </td>
      <td>{{$rombel->kd_kelas}}</td>
    </tr>
    <tr>
      <td>Tahun Ajaran</td>
      <td> : </td>
      <td>{{$rombel->thn_ajaran}}</td>
    </tr>
  </table>
</div>

<hr>

<div class="row">
  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Senin</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $senin=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Senin')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($senin as $sen)
            <tr>
              <td>{{$sen->jam_ke}}</td>
              <td>{{$sen->dari_jam.' - '.$sen->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$sen->id_guru)
                ->first();
              ?>
              <td>{{$sen->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>

  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Selasa</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $selasa=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Selasa')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($selasa as $sel)
            <tr>
              <td>{{$sel->jam_ke}}</td>
              <td>{{$sel->dari_jam.' - '.$sen->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$sel->id_guru)
                ->first();
              ?>
              <td>{{$sel->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>

  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Rabu</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $rabu=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Rabu')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($rabu as $rab)
            <tr>
              <td>{{$rab->jam_ke}}</td>
              <td>{{$rab->dari_jam.' - '.$rab->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$rab->id_guru)
                ->first();
              ?>
              <td>{{$rab->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>

  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Kamis</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $kamis=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Kamis')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($kamis as $kam)
            <tr>
              <td>{{$kam->jam_ke}}</td>
              <td>{{$kam->dari_jam.' - '.$kam->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$kam->id_guru)
                ->first();
              ?>
              <td>{{$kam->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>

  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Jumat</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $jumat=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Jumat')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($jumat as $jum)
            <tr>
              <td>{{$jum->jam_ke}}</td>
              <td>{{$jum->dari_jam.' - '.$jum->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$jum->id_guru)
                ->first();
              ?>
              <td>{{$jum->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>

  <div class="col-sm-6">
    <panel class="panel-primary">
      <div class="panel-heading">
        <p>Sabtu</p>
      </div>

      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <td>Jam Ke -</td>
              <td>Jam</td>
              <td>NIP</td>
              <td>Mapel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $sabtu=DB::table('jadwal')->where('kd_rombel','=',$rombel->kd_rombel)
                ->where('hari','=','Sabtu')
                ->join('jam_pelajaran','jadwal.jam_ke','=','jam_pelajaran.jam_ke')
                ->get();
            ?>
            @foreach($sabtu as $sab)
            <tr>
              <td>{{$sab->jam_ke}}</td>
              <td>{{$sab->dari_jam.' - '.$sab->sampai_jam}}</td>
              <?php
                $mengajar=DB::table('mengajar')->where('id_guru','=',$sab->id_guru)
                ->first();
              ?>
              <td>{{$sab->id_guru}}</td>
              <td>{{$mengajar->kd_mapel}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </panel>
  </div>
</div>