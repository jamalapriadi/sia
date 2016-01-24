<!DOCTYPE HTML>
<html>
	<head>
		<title>SMP N 1 Pagerbarang</title>
		{{HTML::style('assets/css/biru.css')}}
		{{HTML::style('assets/css/datepicker.css')}}
		{{HTML::style('assets/css/jquery.autocomplete.css')}}
		{{HTML::script('assets/js/jquery-1.8.3.min.js')}}
		{{HTML::script('assets/js/bootstrap.min.js')}}
		{{HTML::script('assets/js/bootstrap-datepicker.js')}}
		{{ HTML::style('assets/css/jquery.dataTables.css') }}
		{{ HTML::script('assets/js/jquery.dataTables.js') }}
		{{HTML::script('assets/js/jquery.autocomplete.js')}}
		{{HTML::script('assets/js/jquery-ui.min.js')}}
		{{HTML::style('assets/css/jquery-ui.css')}}
		{{HTML::script('assets/js/Chart.js')}}


		{{HTML::script('assets/tinymce/js/tinymce/tinymce.min.js')}}

		<script>
			$(function(){
				tinymce.init({selector:'textarea'});

				$("#tanggal").datepicker({
					format:"dd-mm-yyyy"
				});

				$("#tanggal2").datepicker({
					format:"dd-mm-yyyy"
				});

				$('#contoh').dataTable();

				var table = $('#contoh').DataTable();

			    $('#contoh tbody').on( 'click', 'tr', function () {
			        if ( $(this).hasClass('selected') ) {
			            $(this).removeClass('selected');
			        }
			        else {
			            table.$('tr.selected').removeClass('selected');
			            $(this).addClass('selected');
			        }
			    } );
			})
		</script>

		<style>
			/* -- datatable -- */
			div.dataTables_wrapper {
			margin-top: 15px;
			}
			div.dataTables_filter label {
			font-weight: normal;
			float: right;
			}
			div.dataTables_filter input,
			div.dataTables_length select {
			height: 30px;
			padding: 4px 6px;
			font-size: 14px;
			max-width: 100%;
			border: 1px solid #dddddd;
			background: #ffffff;
			color: #444444;
			-webkit-transition: all linear 0.2s;
			transition: all linear 0.2s;
			border-radius: 4px;
			}
			div.dataTables_filter input:focus,
			div.dataTables_length select:focus {
				border-color: #99baca;
				outline: 0;
				background: #f5fbfe;
				color: #444444;
			}

			.glyphicon-refresh-animate {
			    -animation: spin .7s infinite linear;
			    -webkit-animation: spin2 .7s infinite linear;
			}

			@-webkit-keyframes spin2 {
			    from { -webkit-transform: rotate(0deg);}
			    to { -webkit-transform: rotate(360deg);}
			}

			@keyframes spin {
			    from { transform: scale(1) rotate(0deg);}
			    to { transform: scale(1) rotate(360deg);}
			}
		</style>
	</head>
	<body>
		<?php
			$user=Sentry::getUser();

			//cari group admin
			$admin=Sentry::findGroupByName('admin');
			$guru=Sentry::findGroupByName('guru');
			$siswa=Sentry::findGroupByName('siswa');
		?>
		@if($user->inGroup($admin))
			@include('template.menu_admin')
		@elseif($user->inGroup($guru))
			@include('template.menu_guru')
		@elseif($user->inGroup($siswa))
			@include('template.menu_siswa')
		@endif

		<div class="container">
			@yield('content')
		</div>

		<footer>
		<div class="foot-fixed-bottom">
		<div class="container">

		<hr />

		© Created By : Jamal Apriadi • Desember 2014</div>
		</div>
		</footer>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Konfirmasi</h4>
		      </div>
		      <div class="modal-body">
		        <p>Apakah anda yakin ingin menghapus data ini??</p>
		        <input type="hidden" id="idhapus">
		        <input type="hidden" id="idhapus2">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</body>
</html>
