<nav class="navbar navbar-default">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="{{URL::to('/')}}">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{URL::to('sejarah')}}">Sejarah</a></li>
              <li><a href="{{URL::to('visi-misi')}}">Visi Misi</a></li>
              <li><a href="{{URL::to('struktur-organisasi')}}">Struktur Organisasi</a></li>
            </ul>
          </li>
          <li><a href="{{URL::to('berita')}}">Berita</a></li>
          <li><a href="{{URL::to('galery')}}">Galery</a></li>
          <li><a href="{{URL::to('buku-tamu')}}">Buku Tamu</a></li>
          <li><a href="{{URL::to('form-pendaftaran')}}">Pendaftaran Siswa Baru</a></li>
        </ul>
      </div>
</nav>