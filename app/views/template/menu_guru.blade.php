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
      <a class="navbar-brand" href="{{URL::to('guru/index')}}">SMP N 1 Pagerbarang</a>
    </div>

    <ul class="nav navbar-nav">
      <li><a href="{{URL::to('guru/index')}}">Beranda</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Akademik <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{URL::to('guru/rombel')}}">Rombel</a></li>
          <li><a href="{{URL::to('guru/mengajar')}}">Mengajar</a></li>
        </ul>
      </li>
      <li><a href="{{URL::to('guru/materi')}}">Materi</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Penilaian <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{URL::to('guru/n_harian')}}">Nilai Harian</a></li>
          <li><a href="{{URL::to('guru/n_ujian')}}">Nilai Ujian</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{URL::to('guru/lap_harian')}}">Nilai Harian</a></li>
          <li><a href="{{URL::to('guru/lap_ujian')}}">Nilai Ujian</a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Sentry::getUser()->username}} <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{URL::to('guru/profile')}}">Profile</a></li>
          <li><a href="{{URL::to('guru/password')}}">Password</a></li>
          <li><a href="{{URL::to('logout')}}">Keluar</a></li>
        </ul>
      </li>
    </ul>
  </div>


  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">

  </div><!-- /.navbar-collapse -->
</nav>
