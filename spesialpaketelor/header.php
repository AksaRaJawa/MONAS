<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	include 'cek.php';
	include 'config.php';
	?>

	<link rel="shorcut icon" href="../logo/ikon.ico"/>
	<title>Mobile Distribution Tools</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="" class="navbar-brand">Mobile Distribution Tools</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<!---<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li> -->
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , <?php echo $_SESSION['uname']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>

			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="row">
		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="it_modis.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>
			<li><a href="depo.php"><span class="glyphicon glyphicon-file"></span>  Depo & Region</a></li>
			<li><a href="merk.php"><span class="glyphicon glyphicon-file"></span>  Merk Device</a></li>
			<li><a href="jabatan.php"><span class="glyphicon glyphicon-file"></span>  Jabatan Salesman</a></li>
			<li><a href="kepemilikan.php"><span class="glyphicon glyphicon-file"></span>  Kepemilikan Device</a></li>
			<li><a href="karyawan.php"><span class="glyphicon glyphicon-book"></span>  Data Salesman</a></li>
			<li><a href="aset.php"><span class="glyphicon glyphicon-book"></span>  Data Aset</a></li>
            <li><a href="histori.php"><span class="glyphicon glyphicon-refresh"></span>  History</a></li>
            <li><a href="pindahan.php"><span class="glyphicon glyphicon-refresh"></span>  Log Perpindahan</a></li>
			<!--<li><a href="ganti_foto.php"><span class="glyphicon glyphicon-picture"></span>  Ganti Foto</a></li> -->
			<li><a href="user.php"><span class="glyphicon glyphicon-user"></span>  Data User</a></li>
			<li><a href="index.php"><span class="glyphicon glyphicon-tasks"></span> Menu </a></li>
			<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
		</ul>
	</div>
	<div class="col-md-10">
