@extends('web.template')

@section('content')
	<!--gallery-->
						<div id="carousel-example-generic" class="carousel slide">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner">
						    <div class="item active">
						      <img src="{{URL::to('assets/img/slide1.jpg')}}" alt="Header" style="width:100%">
						      <div class="carousel-caption">
						        <p></p>
						      </div>
						    </div>

						    <div class="item">
						      <img src="{{URL::to('assets/img/slide2.jpg')}}" alt="Header" style="width:100%">
						      <div class="carousel-caption">
						        <p></p>
						      </div>
						    </div>

						    <div class="item">
						      <img src="{{URL::to('assets/img/slide3.jpg')}}" alt="Header" style="width:100%">
						      <div class="carousel-caption">
						        <p></p>
						      </div>
						    </div>

						    <div class="item">
						      <img src="{{URL::to('assets/img/slide4.jpg')}}" alt="Header" style="width:100%">
						      <div class="carousel-caption">
						        <p></p>
						      </div>
						    </div>
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						    <span class="icon-prev"></span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						    <span class="icon-next"></span>
						  </a>
						</div>
						<!--end gallery-->

						<hr>
						<a href="{{URL::to('web/sambutan')}}"><h4>Sambutan Kepala Sekolah SMP N 1 Pagerbarang</h4></a>

						<img src="{{URL::to('assets/img/user-5.png')}}" class="img-thumbnail" style="width:160px; margin-right:20px; float:left;">
						<p style="text-align:justify; line-height: 200%;">
						Assalamu'alaikum Wr. Wb.
Segala puji dan syukur hanya milik Allah SWT. Shalawat dan salam semoga
senantiasa tercurah kepada Nabi Muhammad SAW.
Saya  Samukri, S.Pd.  selaku  kepala   SMP Negeri 1 Pagerbarang,  
mengucapkan selamat berkunjung di website resmi SMP Negeri 1 Pagerbarang.
Kami    berharap,   website     ini     bermanfaat     sebagai    media    informasi,
komunikasi   dan   silaturrahim   antara   keluarga   besar   SMP  Negeri 1 Jatibarang,
orang  tua/wali  siswa, dan  masyarakat  umum.  Kami juga berharap website
ini memberikan sumbangsih bagi dunia pendidikan.

Demikian yang dapat saya sampaikan. Selamat Berkunjung dan Terimakasih.
Wassalamu'alaikum Wr. Wb. </p>
@stop