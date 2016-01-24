<!DOCTYPE html>
<html>
  <head>
    <title>{{$title}}</title>
    {{HTML::style('assets/css/bootstrap.css')}}
  </head>
  <body>
    <div class="container">
      <?php $setting=Setting::first();?>
      {{HTMl::image('uploads/logo/'.$setting->logo_sekolah,'',array('style'=>'width:100px; float:left; margin-right:10px;'))}}
      <h3>{{$setting->nm_sekolah}}</h3>
      <p style="line-height:13px;">{{$setting->alamat_sekolah.' , Kec. '.$setting->kecamatan.' - Kab. '.$setting->kabupaten}}</p>
      <p style="line-height:13px;">No. Telp : {{$setting->telp_sekolah}} -  Fax : {{$setting->fax_sekolah}}</p>

      <hr>

      <h4 style="text-align:center;">
        <u>{{$title}}</u>
      </h4>
      @yield('content')
    </div>
  </body>
</body>
