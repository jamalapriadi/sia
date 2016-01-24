<!DOCTYPE html>
<html>
  <head>
    <title>Latihan Nilai</title>
    {{HTML::style('assets/css/bootstrap.css')}}
  </head>
  <body>
    <div class="container">
      <legend>Nilai Harian</legend>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan='3'>NIS</th>
            <th colspan="12">Jenis Nilai</th>
          </tr>
          <tr>
            @foreach($jenis as $row)
              <td colspan="4">{{$row->kd_jenis}}</td>
            @endforeach
          </tr>
       </thead>
       <tbody>
         @foreach($nilai as $n)
          <tr>
            <td>{{$n->nis}}</td>
            <td>{{$n->no_urut}}</td>
          </tr>
        @endforeach
       </tbody>
     </table>
    </div>
  </body>
</html>
