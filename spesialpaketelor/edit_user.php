<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit User</h3>
<a class="btn" href="user.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$uname=$_GET['id'];
$det=sqlsrv_query($kon, "select * from [user] where uname='$uname'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_user.php" method="post">
	<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="uname" value="<?php echo $d['uname'] ?>"></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td><input name="uname" type="text" class="form-control"  value="<?=$d['uname']?>" autocomplete="off" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input name="pass" type="text" class="form-control" value="<?=base64_decode($d['pass'])?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td><input name="nama_lengkap" type="text" class="form-control" value="<?=$d['nama_lengkap']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Hak Akses</td>
				<td><select class="form-control" id="akses" name="akses" onchange = "ChangesAkses()">
							<option value="DEPO"> DEPO </option>
							<option value="REGION"> REGION </option>
							<option value="HO"> HO </option>
							<option value="GA"> ASURANSI - GA </option>
							</select></td>
			</tr>
			<script type="text/javascript">
								    function ChangesAkses(){
									var fr = document.getElementById('akses').value;
									var xr = String(fr);
									if(xr=='DEPO')
									{
								    document.getElementById('nama_depo').disabled = false;
									}else if(xr=='REGION')
									{
									document.getElementById('nama_depo').disabled = false;
									}
									else if(xr=='HO')
									{
									document.getElementById('nama_depo').disabled = true;
									}
									else if(xr=='GA')
									{
									document.getElementById('nama_depo').disabled = true;
									}
									};
									</script>
			<tr>
				<td>Depo</td>
				<td><select class="form-control" id="nama_depo" name="nama_depo" onchange="ChangesValue()">
							<option value=" --- ">- Pilih Depo -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from depo");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['id_depo'].'---'.$rw['nama_depo'].'---'.$rw['nama_region'].'">'.$rw['nama_depo'].'</option> ';
								}
								?>
							</select></td>
			</tr>
			<tr>
				<td>Region</td>
				<td><span type="text" id="nama_region" name="nama_region" class="form-control" disabled="disabled"> </span>
							<script type="text/javascript">
								    function ChangesValue(){
									var fr = document.getElementById('nama_depo').value;
									var xr = String(fr);
									var rr = xr.split("---");
									document.getElementById('nama_region').innerHTML = rr[2];
									};
									</script></td>
			</tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>

	</form>
	<?php
}
?>
<script type="text/javascript">
		$(document).ready(function(){
			//$("#tgl").datepicker($.datepicker.regional["id"]);
			$("#tgl").datepicker({dateFormat : 'dd/MM/yy'});

		});
	</script>
<?php include 'footer.php'; ?>
