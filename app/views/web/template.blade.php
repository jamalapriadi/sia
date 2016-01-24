<!DOCTYPE HTML>
<html>
	<head>
		<title>SMP N 1 Pagerbarang</title>
		{{HTML::style('assets/css/yeti.css')}}
		{{HTML::script('assets/js/jquery-1.8.3.min.js')}}
		{{HTML::script('assets/js/bootstrap.js')}}
		<style>
			body{
				background: url("{{URL::to('assets/img/pt.png')}}");
			}
			#header{
				min-height: 220px;
				width: 100%;
				background: url("{{URL::to('assets/img/banner.jpg')}}");
				background-size:100%;
			}
			.container{
				width: 80%;
				padding: 0px;
				min-height: 700px;
				border:1px solid lightgray;
				background: white;
			}
			#isi{
				padding: 20px;
			}
			#footer{
				min-height: 220px;
				margin:0 auto;
				width: 80%;
				background: url("{{URL::to('assets/img/footer.jpg')}}");
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div id="header"></div>

			<!-- menu-->
			@include('web.header')
			<!-- end menu-->

			<!--isi-->
			<div id="isi">
				<div class="row">
					<div class="col-md-8">
						@yield('content')

						<hr>
						<!--module-->
						<div class="row">
							<div class="col-md-3">
								<a href="{{URl::to('berita')}}">
									<img src="{{URL::to('assets/img/berita.png')}}" width="100px;">
								</a>
							</div>

							<div class="col-md-3">
								<a href="{{URL::to('login')}}" target="new target">
									<img src="{{URL::to('assets/img/login.png')}}" width="100px;">
								</a>
							</div>

							<div class="col-md-3">
								<a href="{{URL::to('kontak')}}">
									<img src="{{URL::to('assets/img/kontak.png')}}" width="100px;">
								</a>
							</div>
						</div>


					</div>

					<!--end module-->
					<div class="col-md-4">
						@include('web.sidebar')
					</div>
				</div>
			</div>
			<!--end isi-->
		</div>

		<div style="clear:both"></div>
		<div id="footer">
			
		</div>
	</body>
</html>