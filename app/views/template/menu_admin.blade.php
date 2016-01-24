		<div class="navbar navbar-default" style="border-radius:0 0 0 0;">
			<div class="container">
		  <div class="navbar-collapse collapse navbar-responsive-collapse">
		    <ul class="nav navbar-nav">
		      <li><a href="{{URL::to('admin/index')}}"> <i class="glyphicon glyphicon-home"></i> Beranda</a></li>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-cloud"></i> Website <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          	<li><a href="{{URL::to('admin/kategori')}}">Kategori</a></li>
		          	<li><a href="{{URL::to('admin/berita')}}">Berita</a></li>
								<li><a href="{{URL::to('admin/ekstrakurikuler')}}">Ekstrakuriluler</a></li>
								<li><a href="{{URL::to('admin/banner')}}">Banner</a></li>
								<li><a href="{{URL::to('admin/gallery')}}">Gallery</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-file"></i> Master <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="{{URL::to('admin/mapel')}}">Mapel</a></li>
		          <li><a href="{{URL::to('admin/kelas')}}">Kelas</a></li>
		          <li><a href="{{URL::to('admin/siswa')}}">Siswa</a></li>
		          <li><a href="{{URL::to('admin/guru')}}">Guru</a></li>
		          <li><a href="{{URL::to('admin/jam')}}">Jam Pelajaran</a></li>
		        </ul>
		      </li>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-transfer"></i> Setup <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		        	<li><a href="{{URL::to('admin/kkm')}}">Nilai KKM</a></li>
		          <li><a href="{{URL::to('admin/rombel')}}">Rombel</a></li>
		          <li><a href="{{URL::to('admin/mengajar')}}">Mengajar</a></li>
		          <li><a href="{{URL::to('admin/jadwal')}}">Jadwal</a></li>
		        </ul>
		      </li>

		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-list-alt"></i> Kesiswaan <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		        	<li><a href="{{URL::to('admin/pindah_kelas')}}">Pindah Kelas</a></li>
		          <li><a href="{{URL::to('admin/kenaikan_kelas')}}">Kenaikan Kelas</a></li>
		          <li><a href="{{URL::to('admin/tinggal_kelas')}}">Tinggal Kelas</a></li>
		        </ul>
		      </li>

		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> User <b class="caret"></b></a>
		        <ul class="dropdown-menu">
								<li><a href="{{URL::to('admin/group')}}">Group</a></li>
		          	<li><a href="{{URL::to('admin/user')}}">User</a></li>
		        </ul>
		      </li>

		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-print"></i> Laporan <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="{{URL::to('admin/lap_rombel')}}">Rombel</a></li>
		          <li><a href="{{URL::to('admin/lap_mengajar')}}">Mengajar</a></li>
							<li><a href="{{URL::to('admin/lap_jadwal')}}">Jadwal</a></li>
							<li><a href="{{URL::to('admin/lap_n_harian')}}">Nilai Harian</a></li>
							<li><a href="{{URL::to('admin/lap_n_ujian')}}">Nilai Ujian</a></li>
		        </ul>
		      </li>


		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		    	<li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			          <li><a href="{{URL::to('admin/setting')}}">Profile</a></li>
								<li><a href="#">Backup</a></li>
								<li><a href="#">Restore</a></li>
			        </ul>
			    </li>

		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Sentry::getUser()->username}} <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="{{URL::to('logout')}}">Logout</a></li>
		        </ul>
		      </li>
		    </ul>
		  </div>
		  </div>
		</div>
