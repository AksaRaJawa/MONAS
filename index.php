<!DOCTYPE html>

<html>
<head>
	<link rel="shorcut icon" href="logo/ikon.ico"/>
	<title>Monitoring Asset (MONAS) Tools == &reg SNS</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
	<?php
	include 'admin/config.php';
	?>
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
		<?php
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username/NIK dan Password Salah !!. Atau akun anda sudah tidak aktif, Silahkah hubungi IT HO untuk mengaktifkan kembali.</div>";
			}
		}
		?>
		<div class="panel panel-default" >
			<form action="login_act.php" method="post" id="form-login">
				<div class="col-md-4 col-md-offset-4 kotak">
					<h3 style="text-align:center">SILAHKAN LOGIN</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="NIK" name="uname" onkeyup = "validAngka(this)">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" id="pass" name="pass">
					</div>
					<div class="input">
						<input type="checkbox" id="show-hide" name="show-hide" ><label>&nbsp;Show Password</label>
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<!--<a href="" data-toggle="modal" data-target="#myModal">Lupa Password ?</a>-->
					</div>
					<div class="input-group">
						<input type="submit" class="btn btn-info pull-right" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-background.jpg", {speed: 500});
    </script>
</body>
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Email Permintaan Password
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
						<label>Masukan NIK Anda</label>
						<input name="nik" type="text" class="form-control" id="nik" maxlength="8" onkeyup="validAngka(this)" required>
						</div>
						<div class="form-group">
						<label>Masukan Username Email Anda</label>
						<input name="username" type="text" class="form-control" id="username" required>
						<p class="help-block"> Masukan sesuai username di email garudafood/snsgroup. Terimakasih</p>
						</div>
						<div class="form-group">
						<label>Masukan Alamat Email Anda</label>
						<input name="email" type="text" class="form-control" id="email" required>
						<p class="help-block"> Masukan email garudafood/snsgroup Anda. Terimakasih</p>
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
	    </div>
	</div>
</div>

<script language='javascript'>
		function validAngka(angka)
		{
			if(!/^[0-9.]+$/.test(angka.value))
			{
				angka.value = angka.value.substring(0,angka.value.length-1000);
			}
		}
    </script>


		<script language="javascript">
		(function() {

	var PasswordToggler = function( element, field ) {
		this.element = element;
		this.field = field;

		this.toggle();
	};

	PasswordToggler.prototype = {
		toggle: function() {
			var self = this;
			self.element.addEventListener( "change", function() {
				if( self.element.checked ) {
					self.field.setAttribute( "type", "text" );
				} else {
					self.field.setAttribute( "type", "password" );
				}
            }, false);
		}
	};

	document.addEventListener( "DOMContentLoaded", function() {
		var checkbox = document.querySelector( "#show-hide" ),
			pwd = document.querySelector( "#pass" ),
			form = document.querySelector( "#form-login" );

			var toggler = new PasswordToggler( checkbox, pwd );

	});

})();

		</script>

</html>
