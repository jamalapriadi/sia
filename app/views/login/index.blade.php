<!DOCTYPE HTML>
<html>
	<head>
		<title>Login Web</title>
		{{HTML::style('assets/css/yeti.css')}}
		<style>
		body{
			background: url("{{URL::to('assets/img/loginbg.jpg')}}");
		}
		#login{
			width:350px;
			margin:0 auto;
			margin-top:80px;
		}
		</style>
	</head>
	<body>
		<div id="login">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<p>Login</p>
				</div>
				<div class="panel-body">
				@if(Session::has('pesan'))
					{{Session::get('pesan')}}
				@endif

					{{Form::open(array('url'=>'authenticate','method'=>'post','class'=>'form-horizontal'))}}
						{{Form::label('username','Username')}}
						{{Form::text('email','',array('class'=>'form-control input-sm'))}}
						{{$errors->first('username')}}

						{{Form::label('password','Password')}}
						{{Form::password('password',array('class'=>'form-control input-sm'))}}
						{{$errors->first('password')}}

						<hr>
						<button class="btn btn-primary">
							Login
						</button>	

						<a href="{{URL::to('/')}}" class="btn btn-default">Kembali</a>
					{{Form::close()}}
				</div>

			</div>
		</div>
	</body>
</html>