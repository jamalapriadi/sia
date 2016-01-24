{{Form::open(array('url'=>'admin/simpan_tinggal_kelas','method'=>'POST'))}}
  <input type="hidden" name="daritahun" value="{{$awal}}">

  <div class='alert alert-info'>
  Info : Proses Kenaikan kelas hanya bisa dilakukan satu kali
  </div>

  <table class='table'>
    <thead>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>JK</th>
        <th style="width:15%;"><input type='checkbox' id='selectall'> <i>Pilih Semua</i></th>
      </tr>
    </thead>
    <?php $no=0; ?>
    @foreach($siswa as $row)
    <?php $no++; ?>
    <tr>
      <td>{{$no}}</td>
      <td>{{$row->nis}}</td>
      <td>{{$row->nm_siswa}}</td>
      <td>{{$row->jk}}</td>
      <td style="width:5%;"><input type='checkbox' name='pilih[]' value="{{$row->nis}}" class='checkbox1'></td>
    </tr>
    @endforeach
  </table>


  <div class="well">
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          {{Form::label('kelas','Kelas')}}
          <select name="kelas" id="" class="form-control">
            @foreach($lain as $row)
              <option value="{{$row->kd_kelas}}">{{$row->kd_kelas}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          {{Form::label('tahun','Tahun Ajaran')}}
          <input type="text" value="{{($setting->dari_tahun+1).'-'.($setting->sampai_tahun+1)}}" readonly="readonly" name="tahun" class="form-control" required="required">
        </div>
      </div>

      <div class="col-sm-3">
        <button class="btn btn-primary" style="margin-top:20px;">
          <i class="glyphicon glyphicon-refresh"></i>
          Proses Kenaikan Kelas
        </button>
      </div>
    </div>
  </div>
{{Form::close()}}
