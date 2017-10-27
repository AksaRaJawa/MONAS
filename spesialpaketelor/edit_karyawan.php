<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Salesman</h3>
<a class="btn" href="karyawan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$nik_karyawan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from karyawan where nik_karyawan='$nik_karyawan'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_karyawan.php" method="post">
	<td><input type="hidden" name="nik_karyawan" value="<?=$d['nik_karyawan']?>"></td>
	<table class="table">
			<tr>
				<td>NIK Karyawan</td>
				<td><input name="nik" type="text" class="form-control"  value="<?=$d['nik_karyawan']?>" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Nama Karyawan</td>
				<td><input name="nama_karyawan" type="text" class="form-control"  value="<?=$d['nama_karyawan']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td><select class="form-control autocomplete" id="nama_jabatan" name="nama_jabatan">
							<option value="<?=$d['nama_jabatan']?>">- Pilih Jabatan -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from jabatan");
								while($rw=sqlsrv_fetch_array($dp)){
									echo'<option value="'.$rw['nama_jabatan'].'">'.$rw['nama_jabatan'].'</option> ';
								}
								?>
							</select></td>
			</tr>
			<tr>
				<td>Depo</td>
				<td><select class="form-control autocomplete" id="id_depo" name="id_depo" onchange="ChangesValue()">
							<option value="<?=$d['id_depo'].'---'.$d['nama_region']?>">- Pilih Depo -</option>
								<?php
								$dp=sqlsrv_query($kon, "select * from depo");
								while($rw=sqlsrv_fetch_array($dp)){
									$dep = $rw['nama_depo'];
									$depx = explode(" ",$dep);
									echo'<option value="'.$rw['id_depo'].'---'.$rw['nama_region'].'">'.$depx[1].' '.$depx[2].' '.$depx[3].' === '.$depx[0].'</option> ';
								}
								?>
							</select></td>
			</tr>
			<tr>
				<td>Region</td>
				<td><span id="nama_region" name="nama_region" class="form-control" autocomplete="off" disabled = "disabled"></span>
							<script type="text/javascript">
								    function ChangesValue(){
									var fr = document.getElementById('id_depo').value;
									var xr = String(fr);
									var rr = xr.split("---");
									document.getElementById('nama_region').innerHTML = rr[1];
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
			$("#id_depo").autocomplete({maxLength:3});
			$("#nama_jabatan").autocomplete({maxLength:10});
		});
	</script>
<?php include 'footer.php'; ?>
