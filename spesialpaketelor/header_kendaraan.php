<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	include "config.php";
	?>

	<link rel="shorcut icon" href="../logo/ikon.ico"/>
	<title>Tools Monitoring Aset Kendaraan</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
</head>
<body>
	<div class="navbar navbar-default" style="background-color:#FE642E">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="" class="navbar-brand" style="color:#fff">Tools Monitoring Aset Kendaraan</a>
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
					<li><a class="dropdown-toggle" style="color:#fff" data-toggle="dropdown" role="button" href="#">Hy , <?php echo $_SESSION['uname']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
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
		<ul class="nav nav-pills nav-stacked" >
			<li class="activekend"><a href="armada_aset.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>
			<li><a href="jenis_kendaraan.php"><span class="glyphicon glyphicon-tags"></span>  Jenis Aset Kendaraan</a></li>
			<li><a href="tipe_kendaraan.php"><span class="glyphicon glyphicon-tags"></span>  Tipe Aset Kendaraan</a></li>
			<li><a href="aset_peripheral.php"><span class="glyphicon glyphicon-book"></span>  Aset Peripheral</a></li>
			<li><a href="aset_kendaraan.php"><span class="glyphicon glyphicon-book"></span>  Aset Kendaraan</a></li>
			<li><a href="histori_aset_kendaraan.php"><span class="glyphicon glyphicon-refresh"></span>  Log History</a></li>
			<li><a href="pindahan_aset_kendaraan.php"><span class="glyphicon glyphicon-refresh"></span>  Log Perpindahan</a></li>
			<li><a href="ganti_pass_kendaraan.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
			<li><a href="index.php"><span class="glyphicon glyphicon-tasks"></span> Menu </a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
		</ul>
	</div>
	<div class="col-md-10">
