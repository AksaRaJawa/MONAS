<?php
include 'header_aset.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Karyawan</h3>
<a class="btn" href="karyawan_perangkat_it.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$nik_karyawan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from karyawan_perangkat_it where nik_karyawan='$nik_karyawan'");
while($d=sqlsrv_fetch_array($det)){
?>
	<form action="update_karyawan_perangkat_it.php" method="post">
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
				<td><input name="nama_jabatan" type="text" class="form-control"  value="<?=$d['nama_jabatan']?>" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Profit Center ID</td>
				<td><input name="id_pc" type="text" class="form-control"  maxlength="6" value="<?=$d['id_pc']?>" autocomplete="off" onkeyup="validAngka(this)"></td>
			</tr>
			<tr>
				<td>Cost Center ID</td>
				<td><input name="id_cc" type="text" class="form-control"  maxlength="10" value="<?=$d['id_cc']?>" autocomplete="off" onkeyup="validAngka(this)"></td>
			</tr>
			<tr>
				<td>Depo</td>
				<td><input name="nama_depo" type="text" class="form-control"  value="<?=$d['nama_depo']?>" autocomplete="off"></td></td>
			</tr>
			<tr>
				<td>Region</td>
				<td><input name="nama_region" type="text" class="form-control"  value="<?=$d['nama_region']?>" autocomplete="off"></td></td>
			</tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>

	</form>
	<?php
}
?>
<script language='javascript'>
	function validAngka(angka)
	{
		if(!/^[0-9.]+$/.test(angka.value))
		{
			angka.value = angka.value.substring(0,angka.value.length-1000);
		}
	}
	</script>
<?php include 'footer.php'; ?>
