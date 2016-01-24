@extends('template.index')
@section('content')
  <legend>Group</legend>

  @if(Session::has('pesan'))
    {{Session::get('pesan')}}
  @endif

  <table class="table table-striped" id="contoh">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Permissions</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $no=0;?>
      @foreach($group as $row)
        <?php $no++;?>
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->permissions}}</td>
          @if($row->name=="admin")
            <td></td>
            <td></td>
          @else
            <td>
              <a href="#" group="{{$row->id}}" class="btn btn-success aktif" title="Non Aktifkan semua user {{$row->name}}">
                <i class="glyphicon glyphicon-thumbs-up"></i>
              </a>
            </td>
            <td>
              <a href="#" group="{{$row->id}}" class="btn btn-danger nonaktif" title="Aktifkan semua user {{$row->name}}">
                <i class="glyphicon glyphicon-thumbs-down"></i>
              </a>
            </td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Modal -->
  <div class="modal fade" id="proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Proses</h4>
        </div>
        <div class="modal-body">
          <div class="progress progress-striped">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
              <span class="sr-only">40% Complete (success)</span>
            </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <script>
    $(function(){
      $('.aktif').click(function(){
        var group=$(this).attr("group");

        $("#proses").modal("show");

        $.ajax({
          url:"{{URL::to('admin/aktifkangroup')}}",
          type:"POST",
          data:"group="+group,
          cache:false,
          success:function(html){
            location.reload();
          }
        })
      })

      $('.nonaktif').click(function(){
        var group=$(this).attr("group");

        $("#proses").modal("show");

        $.ajax({
          url:"{{URL::to('admin/nonaktifkangroup')}}",
          type:"POST",
          data:"group="+group,
          cache:false,
          success:function(html){
            location.reload();
          }
        })
      })
    })
  </script>

@stop
