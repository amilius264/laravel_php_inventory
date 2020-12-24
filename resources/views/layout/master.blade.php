<!doctype html>
<html lang="en">

<head>
	<title>{{ $judul }} | Aplikasi Inventory</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{('/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<!-- <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="{{('/admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{('/admin/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{('/admin/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!-- <link rel="stylesheet" href="{{('/admin/assets/css/demo.css')}}"> -->
	<!-- SweetAlert2 -->
  	<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{('/admin/assets/img/apple-icon.png')}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{('/admin/assets/img/favicon.png')}}">
	@yield('header')
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		@include('layout.include._navbar')
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@include('layout.include._sidebar')
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		@yield('content')
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2020 
					<a href="#" target="_blank">Amilius Pratama</a>
				. Coba - Coba.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{('/admin/assets/vendor/jquery/jquery-3.5.1.min.js')}}"></script>
	<!-- <script src="../../plugins/bootstrap/js/bootstrap.min.js"></script> -->
	<script src="{{('/admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{('/admin/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{('/admin/assets/scripts/klorofil-common.js')}}"></script>
	<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
	<!-- SweetAlert2 -->
	<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Toastr -->
	<script src="../../plugins/toastr/toastr.min.js"></script>
	<script>
		@if(Session::has('sukses'))
			toastr.success("{{Session::get('sukses')}}","Sukses")
		@else if(Session::has('gagal'))
			toastr.error("{{Session::get('gagal')}}","Error")
		@endif
	</script>
	@yield('footer')
</body>

</html>
