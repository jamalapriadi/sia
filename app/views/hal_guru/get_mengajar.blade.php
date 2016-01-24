<table class="table table-striped">
  <thead>
    <tr>
      <th>Tahun Ajaran</th>
      <th>Mapel</th>
    </tr>
  </thead>
  @foreach($ngajar as $row)
    <tr>
      <td>{{$row->thn_ajaran}}</td>
      <td>{{$row->kd_mapel}}</td>
    </tr>
  @endforeach
</table>
