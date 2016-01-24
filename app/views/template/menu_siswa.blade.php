<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::to('siswa/index')}}">SMP N 1 Pagerbarang</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{URL::to('siswa/index')}}">Beranda</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akademik <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{URL::to('siswa/rombel')}}">Rombel</a></li>
            <li><a href="{{URL::to('siswa/mengajar')}}">Mengajar</a></li>
            <li><a href="{{URL::to('siswa/jadwal')}}">Jadwal</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{URL::to('siswa/nilai_harian')}}">Nilai Harian</a></li>
            <li><a href="{{URL::to('siswa/nilai_ujian')}}">Nilai Ujian</a></li>
            <li><a href="{{URL::to('siswa/nilai_raport')}}">Raport</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Sentry::getUser()->username;}} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{URL::to('siswa/profile')}}">Profile</a></li>
            <li><a href="{{URL::to('siswa/password')}}">Password</a></li>
            <li><a href="{{URL::to('logout')}}">Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>
