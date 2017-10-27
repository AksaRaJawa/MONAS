<!DOCTYPE html>

<html>
<head>
	<link rel="shorcut icon" href="../logo/ikon.ico"/>
	<title>Monitoring Asset (MONAS) Tools == &reg SNS</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>

	<style type="text/css">
	.kotak{
		margin-top: 150px;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="panel panel-default" >

				<div class="col-md-4 col-md-offset-4 kotak">
					<h3 style="text-align:center">PILIH MENU</h3>
					<div class="input-group">
            <a href="it_modis.php" class="btn btn-primary" style="width:350px;"><span class="glyphicon glyphicon-tasks"></span> 	Aset MODIS</a>
					</div>
					<div class="input-group">
						<a href="it_aset.php" class="btn btn-success" style="width:350px;"><span class="glyphicon glyphicon-tasks"></span> 	Aset Perangkat IT</a>
					</div>
					<!--<div class="input-group">
						<a href="armada_aset.php" class="btn btn-warning" style="width:350px;"><span class="glyphicon glyphicon-tasks"></span> 	Aset Kendaraan</a>
					</div>-->
				</div>

		</div>
	</div>
	<script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../assets/img/menu-background.jpg", {speed: 500});
    </script>
</body>
<script language='javascript'>
		function validAngka(angka)
		{
			if(!/^[0-9.]+$/.test(angka.value))
			{
				angka.value = angka.value.substring(0,angka.value.length-1000);
			}
		}
    </script>
</html>
