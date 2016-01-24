<table class="table table-bordered">
  <tr>
    <td>Kelas</td>
    <td> : {{$rombel->kd_kelas}}</td>
  </tr>
  <tr>
    <td>Tahun Ajaran</td>
    <td> : {{$rombel->thn_ajaran}}</td>
  </tr>
  <tr>
    <td>Wali Kelas</td>
    <td> : {{$rombel->guru->nm_guru}}</td>
  </tr>
</table>

<table class="table table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>JK</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=0; $l=0; $p=0;?>
    @foreach($detail as $row)
    <?php $no++;
    if($row->jk=='L'){
      $l++;
    }
    if($row->jk=='P'){
      $p++;
    }
    ?>
    <tr>
      <td>{{$no}}</td>
      <td>{{$row->nis}}</td>
      <td>{{$row->nm_siswa}}</td>
      <td>{{$row->jk}}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan='3'>Jumlah Laki - Laki</td>
      <td>{{$l}}</td>
    </tr>
    <tr>
      <td colspan='3'>Jumlah Perempuan</td>
      <td>{{$p}}</td>
    </tr>
    <tr>
      <td colspan='3'>Jumlah Siswa</td>
      <td>{{$l+$p}}</td>
    </tr>
  </tfoot>
</table>
