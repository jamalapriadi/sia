<!DOCTYPE HTML>
<html>
	<head>
		<title>Latihan</title>
		<script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

		<script>
			$(function(){
				$("#coba").autocomplete({
                    source:"{{URL::to('admin/cari_siswa')}}",
                    minLength:1
                });
			})
		</script>
	</head>
	<body>
		<div class="container">
			<legend>Tes</legend>
			<input type="text" id="coba">
		</div>
	</body>
</html>