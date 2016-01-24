<nav class="navbar navbar-default" role="navigation">
			  <!-- Brand and toggle get grouped for better mobile display -->

			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse navbar-ex1-collapse">
			    <ul class="nav navbar-nav">
			      <li><a href="{{URL::to('/')}}">Home</a></li>
			      <li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			          <li><a href="{{URL::to('sejarah')}}">Sejarah</a></li>
			          <li><a href="{{URL::to('visi_misi')}}">Visi dan Misi</a></li>
			        </ul>
			      </li>
			      <li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Guru dan Siswa <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			          <li><a href="{{URL::to('data_guru')}}">Data Guru</a></li>
			          <li><a href="{{URL::to('data_siswa')}}">Data Siswa</a></li>
			        </ul>
			      </li>
			      <li><a href="{{URL::to('berita')}}">Berita</a></li>
			      <li><a href="{{URL::to('gallery')}}">Gallery</a></li>
			      <li><a href="{{URL::to('kontak')}}">Kontak</a></li>
			    </ul>

			    <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
		            <li><a href="{{URL::to('login')}}">Login</a></li>
		        </ul>
			  </div><!-- /.navbar-collapse -->
			</nav>